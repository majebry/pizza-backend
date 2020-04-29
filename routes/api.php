<?php

Route::get('pizzas', 'PizzaController@index');

Route::get('orders', 'OrderController@index')->middleware('auth');
Route::post('orders', 'OrderController@store');
Route::get('orders/{id}', 'OrderController@show')->middleware('auth');

Route::get('settings', 'SettingController@index');

Route::post('login', 'AuthController@issueToken');
