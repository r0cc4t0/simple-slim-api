<?php

namespace src;

use Tuupola\Middleware\HttpBasicAuthentication;

function basicAuth(): HttpBasicAuthentication
{
    return new HttpBasicAuthentication([
        "users" => [
            getenv('USER_BASIC_AUTH') => getenv('PASS_BASIC_AUTH')
        ]
    ]);
}
