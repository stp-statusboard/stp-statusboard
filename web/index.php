<?php

require_once __DIR__.'/../vendor/autoload.php';

use StpBoard\Home\HomeControllerProvider;

$app = new Silex\Application();

$app->register(new \DerAlex\Silex\YamlConfigServiceProvider(__DIR__ . '/../config/config.yml'));

$app->mount('', new HomeControllerProvider());

$app->run();
