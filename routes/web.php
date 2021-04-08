<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function ()      {  return view('welcome');             })->middleware('checkip');

Auth::routes();

Route::group(['middleware' => 'auth', 'checkip'], function(){

  Route::get('/home', 'HomeController@index')->name('home');

  //PANEL RUTAS

  Route::resource('roles',                'Panel\TpRolController');
  Route::resource('sexos',                'Panel\TpSexoController');
  Route::resource('token',                'Panel\TpTokenController');

  Route::resource('ciudad',               'Panel\CityController');
  Route::resource('pais',                 'Panel\CountryController');
  Route::resource('departamento',         'Panel\DepartamentController');

  Route::resource('estatus-sesion',       'Panel\StatusSessionController');
  Route::resource('estatus-usuarios-app', 'Panel\StatusUsersAppController');
  Route::resource('estatus-red',          'Panel\StatusRedController');
  Route::resource('sesiones',             'Panel\SessionController');

  Route::resource('usuarios-app',         'Panel\UsersAppController');
  Route::resource('rol-usuarios',         'Panel\RolUsersController');
  Route::resource('token-usuarios-app',   'Panel\TokenUsersAppController');

  Route::resource('clave-usuarios-app',   'Panel\PasswordUsersAppController');

  Route::resource('menus',                'Panel\MenuController');
  Route::resource('rol-menus',            'Panel\RolMenuController');
  Route::resource('permisos',             'Panel\PermisoController');
  Route::resource('foto-perfil',          'Panel\PhotoPerfilController');
  Route::resource('red-usuarios',         'Panel\RedUsuariosController');
  Route::resource('accesos-ip',           'Panel\AccesosIpController');
  Route::resource('distritos',            'Panel\DistritoController');

  
  //RUTAS PARA USUARIO INTERNO
  Route::match(['get', 'post'], '/updateStatusDistritos',        'Panel\DistritoController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusAccesosIp',        'Panel\AccesosIpController@updateStatus');
  Route::match(['get', 'post'], '/updateBloqueoAcceso',          'Panel\UsersAppController@updateBloqueoAcceso');
  Route::match(['get', 'post'], '/updateStatusRedUsuarios',      'Panel\RedUsuariosController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusStatusRed',        'Panel\StatusRedController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusSession',          'Panel\SessionController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusPhotoPerfil',      'Panel\PhotoPerfilController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusPermisos',         'Panel\PermisoController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusRolMenu',          'Panel\RolMenuController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusStatusSession',    'Panel\StatusSessionController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusTpToken',          'Panel\TpTokenController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusTokenUsersApp',    'Panel\TokenUsersAppController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusPasswordUsersApp', 'Panel\PasswordUsersAppController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusRolUsers',         'Panel\RolUsersController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusStatusUsersApp',   'Panel\StatusUsersAppController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusCity',             'Panel\CityController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusDepartament',      'Panel\DepartamentController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusCountry',          'Panel\CountryController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusTpSexo',           'Panel\TpSexoController@updateStatus');
  Route::match(['get', 'post'], '/updateStatusTpRols',           'Panel\TpRolController@updateStatus');
  Route::MATCH(['get', 'post'], '/getPhotoPerfil',               'Panel\PhotoPerfilController@getPhotoPerfil');
  Route::MATCH(['get', 'post'], '/getPermisos',                  'Panel\PermisoController@getPermisos');
  Route::MATCH(['get', 'post'], '/getRolMenu',                   'Panel\RolMenuController@getRolMenu');
  Route::MATCH(['get', 'post'], '/getSession',                   'Panel\SessionController@getSession');
  Route::MATCH(['get', 'post'], '/getStatusSession',             'Panel\StatusSessionController@getStatusSession');
  Route::MATCH(['get', 'post'], '/getTpToken',                   'Panel\TpTokenController@getTpToken');
  Route::MATCH(['get', 'post'], '/getTokenUsersApp',             'Panel\TokenUsersAppController@getTokenUsersApp');
  Route::MATCH(['get', 'post'], '/getPasswordUsersApp',          'Panel\PasswordUsersAppController@getPasswordUsersApp');
  Route::MATCH(['get', 'post'], '/getRolUsers',                  'Panel\RolUsersController@getRolUsers');
  Route::MATCH(['get', 'post'], '/getStatusUsersApp',            'Panel\StatusUsersAppController@getStatusUsersApp');
  Route::MATCH(['get', 'post'], '/getCity',                      'Panel\CityController@getCity');
  Route::MATCH(['get', 'post'], '/getCountry',                   'Panel\CountryController@getCountry');
  Route::MATCH(['get', 'post'], '/getSexo',                      'Panel\TpSexoController@getSexo');
  Route::MATCH(['get', 'post'], '/getTpRols',                    'Panel\TpRolController@getTpRols');
  Route::MATCH(['get', 'post'], '/getRedUsuarios',               'Panel\RedUsuariosController@getRedUsuarios')->name('redusuarios.get');
  Route::MATCH(['get', 'post'], '/getStatusRed',                 'Panel\StatusRedController@getStatusRed')    ->name('statusreds.get');
  Route::MATCH(['get', 'post'], '/getUsersApps',                 'Panel\UsersAppController@getUsersApps')     ->name('usersapps.get');
  Route::MATCH(['get', 'post'], '/getMenus',                     'Panel\MenuController@getMenus')             ->name('menus.get');
  Route::MATCH(['get', 'post'], '/getDepartament',               'Panel\DepartamentController@getDepartament')->name('departamet.get');
  Route::MATCH(['get', 'post'], '/getAccesosIp',                 'Panel\AccesosIpController@getAccesosIp')    ->name('accesosips.get');
  Route::MATCH(['get', 'post'], '/getDistritos',                 'Panel\DistritoController@getDistritos')     ->name('distritos.get');

});

//GENERALES
Route::MATCH(['get', 'post'], '/departament/{id}', 'Panel\DepartamentController@get')->name('departaments.get')->middleware('checkip');
Route::MATCH(['get', 'post'], '/city/{id}',        'Panel\CityController@get'       )->name('cities.get'      )->middleware('checkip');
Route::MATCH(['get', 'post'], '/distrito/{id}',    'Panel\DistritoController@get'   )->name('distritos.get'   )->middleware('checkip');
