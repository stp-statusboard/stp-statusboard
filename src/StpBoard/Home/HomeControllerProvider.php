<?php

namespace StpBoard\Home;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use StpBoard\Base\BoardProviderInterface;
use StpBoard\Base\TwigTrait;
use StpBoard\Home\Service\BoardItemsService;
use StpBoard\Home\Exception\InvalidConfigException;

class HomeControllerProvider implements ControllerProviderInterface
{
    use TwigTrait;

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $this->initProviders($app);

        return $this->initController($app);
    }

    /**
     * @param Application $app
     * @throws \Exception
     */
    protected function initProviders(Application $app)
    {
        if (!isset($app['config']) ||
            !isset($app['config']['boards']) ||
            !is_array($app['config']['boards'])
        ) {
            return;
        }

        $providers = [];

        foreach ($app['config']['boards'] as $board) {
            if (!isset($board['items'])) {
                continue;
            }

            foreach ($board['items'] as $item) {
                if (!isset($item['provider'])) {
                    throw new InvalidConfigException('Provider class is required');
                }

                $providers[$item['provider']] = true;
            }
        }

        foreach (array_keys($providers) as $provider) {
            /** @var BoardProviderInterface|ControllerProviderInterface $providerObject */
            $providerObject = new $provider;
            $app->mount($providerObject->getRoutePrefix(), $providerObject);
        }
    }

    /**
     * @param Application $app
     * @return mixed
     */
    protected function initController(Application $app)
    {
        $that = $this;
        $this->initTwig(__DIR__ . '/views');

        $controllers = $app['controllers_factory'];
        $boards = [];

        foreach ($app['config']['boards'] as $id => $board) {
            $boards[] = ['id' => $id] + $board;
            $controllers->get(
                '/boards/' . $id,
                function () use ($that, $board) {
                    $board['items'] = BoardItemsService::initBoardItems($board['items']);

                    return $that->twig->render('index.html.twig', $board);
                }
            );
        }

        $controllers->get(
            '/',
            function () use ($that, $boards) {
                return $that->twig->render(
                    'boards.html.twig',
                    [
                        'boards' => $boards
                    ]
                );
            }
        );

        return $controllers;
    }
}
