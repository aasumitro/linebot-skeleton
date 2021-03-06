<?php

/*
|----------------------------------------------------
| Container                                         |
|----------------------------------------------------
*/
    $container = $app->getContainer();

/*
|----------------------------------------------------
| Monolog                                           |
|----------------------------------------------------
*/
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new Monolog\Logger($settings['name']);
        $logger->pushProcessor(new Monolog\Processor\UidProcessor());
        $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

/*
|----------------------------------------------------
| LINE BOT                                          |
|----------------------------------------------------
*/

    $container['line'] = function ($c) {
        $settings = $c->get('settings')['line'];
        return $settings;
    };

/*
|----------------------------------------------------
| Eloquent ORM
|----------------------------------------------------
*/

    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
