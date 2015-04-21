<?php

namespace StpBoard\Clock;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use StpBoard\Base\BoardProviderInterface;
use StpBoard\Base\TwigTrait;

class ClockControllerProvider implements ControllerProviderInterface, BoardProviderInterface
{
    use TwigTrait;

    /**
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $this->initTwig(__DIR__ . '/views');
        $controllers = $app['controllers_factory'];

        $controllers->get(
            '/',
            function (Application $app) {
                $request = $app['request'];

                return $this->twig->render(
                    'clock.html.twig',
                    [
                        'id' => $request->get('id')
                    ]
                );
            }
        );

        return $controllers;
    }

    /**
     * Returns route prefix, starting with "/"
     *
     * @return string
     */
    public static function getRoutePrefix()
    {
        return '/clock';
    }
}
