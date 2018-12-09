<?php

$namespace = "ARJUN\JWT\CONTROLLERS";
$middleware= ARJUN\JWT\MIDDLEWARES\CORS::class;

Route::group(['prefix' => 'api', 'middleware' => 'cors', 'namespace' => $namespace], function () {
    Route::post('login', 'JWTAUTHCONTROLLER@login');
    Route::post('logout', 'JWTAUTHCONTROLLER@logout');
    Route::post('refresh', 'JWTAUTHCONTROLLER@refresh');
    Route::post('me', 'JWTAUTHCONTROLLER@me');
    Route::post('payload', 'JWTAUTHCONTROLLER@payload');
});
