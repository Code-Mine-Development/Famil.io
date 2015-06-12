<?php
return array(
    'router' => array(
        'routes' => array(
            'oauth' => array(
                'options' => array(
                    'spec' => '%oauth%',
                    'regex' => '(?P<oauth>(/oauth))',
                ),
                'type' => 'regex',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(
            'adapters' => array(
                'mysqloauthadapter' => array(
                    'adapter' => 'ZF\\MvcAuth\\Authentication\\OAuth2Adapter',
                    'storage' => array(
                        'adapter' => 'pdo',
                        'dsn' => 'mysql:host=localhost;dbname=famillio',
                        'route' => '/oauth',
                        'username' => 'family',
                        'password' => 'familly',
                    ),
                ),
            ),
        ),
    ),
);
