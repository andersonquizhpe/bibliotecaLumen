<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
//Usuarios
$router->group(['prefix'=>'usuarios'], function($router){
    $router->get('','UserController@getUsers');
    $router->post('/login', 'UserController@login');
});
//Genero
$router->group(['prefix'=>'generos'], function($router){
    $router->get('','GeneroController@getGeneros');
    $router->get('/get/{id}','GeneroController@getOneGenero');
    $router->post('/create','GeneroController@createGenero');
    $router->put('/edit/{id}','GeneroController@updateGenero');
    $router->get('/delete/{id}','GeneroController@deleteGenero');
});

//autor
$router->group(['prefix'=>'autores'], function($router){
    $router->get('','AutorController@getAutor');
    $router->get('/get/{id}','AutorController@getOneAutor');
    $router->get('/delete/{id}',"AutorController@deleteAutor");
    $router->post('/create', 'AutorController@createAutor');
    $router->put('/edit/{id}', 'AutorController@updateAutor');
});

//libros
$router->group(['prefix'=>'libros'], function($router){
    $router->get('','LibroController@getLibros');
    $router->get('/get/{id}','LibroController@getLibroOne');
    $router->get('/getAutor/{id}','LibroController@getLibroAutor');
    $router->get('/getGenero/{id}','LibroController@getLibroGenero');
    $router->get('/delete/{id}','LibroController@deleteLibro');
});

//librosIns
$router->group(['prefix'=>'libroIns'], function($router){
    $router->get('','LibroInsController@getLibros');
    $router->get('/prestamos','LibroInsController@getLibrosPrestamos');
    $router->get('/devueltos','LibroInsController@getLibrosDevueltos');
    $router->get('/get/{id}','LibroInsController@getLibroOne');
    $router->post('/create','LibroInsController@crear');
    $router->put('/edit/{id}','LibroInsController@update');
});
