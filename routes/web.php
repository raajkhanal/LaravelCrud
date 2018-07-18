<?php
Route::any('/','UserController@index')->name('index');
Route::any('addUser','UserController@addUser')->name('addUser');
Route::any('viewUser','UserController@viewUser')->name('viewUser');
Route::any('deleteUser/{id?}','UserController@deleteUser')->name('deleteUser');
Route::any('editUser/{id?}','UserController@editUser')->name('editUser');
Route::any('editUserAction}','UserController@editUserAction')->name('editUserAction');