<?php

Route::get('pizzas', 'PizzaController@index');

Route::post('orders', 'OrderController@store');

Route::get('settings', 'SettingController@index');

Route::post('login', 'AuthController@issueToken');
