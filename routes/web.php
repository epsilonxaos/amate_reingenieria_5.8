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
use Illuminate\Support\Facades\Route;

Route::get('/foo', 'AppController@serviciosArtisan') -> name('app.comandos');
Route::get('/', 'AppController@index') -> name('app.index');
Route::put('/save/registro', 'RegistrosController@store') -> name('app.save.reg');


// Route::get('/', 'AdminController@unauthenticated')->name('panel.admins.unauthenticated');

// Panel
Route::prefix('/admin')->group(function(){
    Route::get('/', 'AdminController@unauthenticated')->name('panel.admins.unauthenticated');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showAdminLinkRequestForm')->name('panel.admins.password.reset');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendAdminResetLinkEmail')->name('panel.admins.password.email');
    Route::post('/login', 'AdminController@login')->name('panel.admins.login');
    Route::post('/logout', 'AdminController@logout')->name('panel.admins.logout');
    

    //Administradores
    Route::prefix('/cuentas')->middleware('auth:admin')->group(function(){
        Route::prefix('/usuarios')->group(function(){
            Route::get('/', 'AdminController@index')->name('panel.admins.index');
            Route::get('/nuevo', 'AdminController@create')->name('panel.admins.create');
            Route::post('/store', 'AdminController@store')->name('panel.admins.store');
            Route::get('/editar/{id}', 'AdminController@edit')->name('panel.admins.edit');
            Route::put('/update/{id}', 'AdminController@update')->name('panel.admins.update');
            Route::get('/password/editar/{id}', 'AdminController@editPassword')->name('panel.admins.edit.password');
            Route::put('/password/update/{id}', 'AdminController@updatePassword')->name('panel.admins.update.password');
            Route::delete('/destroy/{id}', 'AdminController@destroy')->name('panel.admins.destroy');
        });

        Route::prefix('/roles')->group(function(){
            Route::get('/', 'RoleController@index')->name('panel.roles.index');
            Route::get('/nuevo', 'RoleController@create')->name('panel.roles.create');
            Route::get('/editar/{id}', 'RoleController@edit')->name('panel.roles.edit');
            Route::post('/store', 'RoleController@store')->name('panel.roles.store');
            Route::put('/update/{id}', 'RoleController@update')->name('panel.roles.update');
            Route::delete('/destroy/{id}', 'RoleController@destroy')->name('panel.roles.destroy');
        });
    });

    Route::prefix('/seo')->middleware('auth:admin')->group(function(){
        Route::get('/', 'SettingController@index')->name('panel.seo.index');
        Route::post('/update/{id}', 'SettingController@update')->name('panel.seo.update');
    });

    //Settings
    Route::prefix('/configuracion')->middleware('auth:admin')->group(function(){
        Route::get('/editar/seo', 'SettingController@edit')->name('panel.settings.seo');
        Route::get('/editar/seo/facebook', 'SettingController@facebook')->name('panel.settings.seo.facebook');
        Route::get('/editar/seo/analytics', 'SettingController@analytic')->name('panel.settings.seo.analytic');
        Route::put('/editar/seo', 'SettingController@update')->name('panel.settings.seo.update');
    });

    //Portafolio
    Route::prefix('/portafolio') -> middleware('auth:admin') -> group(function () {
        Route::get('/', 'PortafolioController@index') -> name('panel.portafolio.index');
        Route::get('/create', 'PortafolioController@create') -> name('panel.portafolio.create');
        Route::put('/create/store', 'PortafolioController@store') -> name('panel.portafolio.store');
        Route::get('/edit/{id}', 'PortafolioController@edit') -> name('panel.portafolio.edit');
        Route::post('/edit/{id}/update', 'PortafolioController@update') -> name('panel.portafolio.update');
        Route::delete('/destroy/{id}', 'PortafolioController@destroy') -> name('panel.portafolio.destroy');
        Route::post('/change/status', 'PortafolioController@changeStatus') -> name('panel.portafolio.status');

        // Galeria
        Route::prefix('/galeria') -> middleware('auth:admin') -> group(function(){
            Route::get('/{accion}/{id}', 'PortafolioController@createGaleria') -> name('panel.portafolio.galeria.acciones');
            Route::post('/add', 'PortafolioController@storeGaleria') -> name('panel.portafolio.galeria.store');
            Route::post('/ordenamiento', 'PortafolioController@ordenamiento') -> name('panel.portafolio.galeria.ordenamiento');
            Route::post('/destroy', 'PortafolioController@destroyImageGallery') -> name('panel.portafolio.galeria.destroy');
        });
    });

    //Categorias
    Route::prefix('/categorias') -> middleware('auth:admin') -> group(function(){
        Route::get('/{seccion}', 'CategoriasController@index') -> name('panel.categorias.index');
        Route::get('/{seccion}/create', 'CategoriasController@create') -> name('panel.categorias.create');
        Route::put('/{seccion}/create/store', 'CategoriasController@store') -> name('panel.categorias.store');
        Route::get('/{seccion}/edit/{id}', 'CategoriasController@edit') -> name('panel.categorias.edit');
        Route::post('/{seccion}/edit/{id}/update', 'CategoriasController@update') -> name('panel.categorias.update');
        Route::delete('/destroy/{id}', 'CategoriasController@destroy') -> name('panel.categorias.destroy');
        Route::post('/change/status', 'CategoriasController@changeStatus') -> name('panel.categorias.status');
    });

    //Orden
    Route::prefix('/ventas') -> middleware('auth:admin') -> group(function(){
        Route::get('/', 'OrdenController@index') -> name('panel.orden.index');
        Route::get('/create', 'OrdenController@create') -> name('panel.orden.create');
        Route::put('/create/store', 'OrdenController@store') -> name('panel.orden.store');
        Route::get('/{id}/precios', 'OrdenController@getListPrecios') -> name('panel.orden.precios');
        Route::get('/show/{id}', 'OrdenController@show') -> name('panel.orden.show');
    });

    //Cupones
    Route::prefix('/cupones') -> middleware('auth:admin') -> group(function(){
        Route::get('/', 'CuponController@index') -> name('panel.cupon.index');
        Route::get('/create', 'CuponController@create') -> name('panel.cupon.create');
        Route::put('/create/store', 'CuponController@store') -> name('panel.cupon.store');
        Route::get('/edit/{id}', 'CuponController@edit') -> name('panel.cupon.edit');
        Route::post('/edit/{id}/update', 'CuponController@update') -> name('panel.cupon.update');
        Route::delete('/destroy/{id}', 'CuponController@destroy') -> name('panel.cupon.destroy');
        Route::post('/change/status', 'CuponController@changeStatus') -> name('panel.cupon.status');
    });

    //Experiencias o Eventos
    Route::prefix('/evento') -> middleware('auth:admin') -> group(function(){
        Route::get('/', 'EventoController@index') -> name('panel.evento.index');
        Route::get('/create', 'EventoController@create') -> name('panel.evento.create');
        Route::put('/create/store', 'EventoController@store') -> name('panel.evento.store');
        Route::get('/edit/{id}', 'EventoController@edit') -> name('panel.evento.edit');
        Route::post('/edit/{id}/update', 'EventoController@update') -> name('panel.evento.update');
        Route::delete('/destroy/{id}', 'EventoController@destroy') -> name('panel.evento.destroy');
        Route::post('/change/status', 'EventoController@changeStatus') -> name('panel.evento.status');
        Route::post('/change/desctacar', 'EventoController@changeDestacar') -> name('panel.evento.destacar');

        // Galeria
        Route::prefix('/galeria') -> middleware('auth:admin') -> group(function(){
            Route::get('/{accion}/{id}', 'EventoController@createGaleria') -> name('panel.evento.galeria.acciones');
            Route::post('/add', 'EventoController@storeGaleria') -> name('panel.evento.galeria.store');
            Route::post('/ordenamiento', 'EventoController@ordenamiento') -> name('panel.evento.galeria.ordenamiento');
            Route::post('/destroy', 'EventoController@destroyImageGallery') -> name('panel.evento.galeria.destroy');
            Route::post('/update', 'EventoController@updateUrlGallery') -> name('panel.evento.galeria.update');
        });
    });

    //Noticias
    Route::prefix('/noticias') -> middleware('auth:admin') -> group(function(){
        Route::get('/', 'NoticiasController@index') -> name('panel.noticias.index');
        Route::get('/create', 'NoticiasController@create') -> name('panel.noticias.create');
        Route::put('/create/store', 'NoticiasController@store') -> name('panel.noticias.store');
        Route::get('/edit/{id}', 'NoticiasController@edit') -> name('panel.noticias.edit');
        Route::post('/edit/{id}/update', 'NoticiasController@update') -> name('panel.noticias.update');
        Route::delete('/destroy/{id}', 'NoticiasController@destroy') -> name('panel.noticias.destroy');
        Route::post('/change/status', 'NoticiasController@changeStatus') -> name('panel.noticias.status');
    });

    // Website
    Route::prefix('/website') -> middleware('auth:admin') -> group(function(){
        Route::get('/', 'WebsiteController@edit') -> name('panel.website.edit');
        Route::post('/edit/update', 'WebsiteController@update') -> name('panel.website.update');
    });
});
