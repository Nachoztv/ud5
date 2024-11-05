<?php

namespace Com\Daw2\Core;

use Com\Daw2\Controllers\EjerciciosController;
use Steampixel\Route;
use \App\Controllers;

class FrontController
{
    public static function main()
    {
        Route::add(
            '/',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->index();
            },
            'get'
        );

        Route::add(
            '/test',
            function () {
                $controlador = new EjerciciosController();
                $controlador->showFormularioNombre();
            },
            'get'
        );

        Route::add(
            '/test',
            function () {
                $controlador = new EjerciciosController();
                $controlador->doFormularioNombre();
            },
            'post'
        );

        Route::add(
            '/anagrama',
            function () {
                $controlador = new EjerciciosController();
                $controlador->showAnagrama();
            },
            'get'
        );

        Route::add(
            '/anagrama',
            function () {
                $controlador = new EjerciciosController();
                $controlador->doAnagrama();
            },
            'post'
        );

        Route::add(
            '/mismas-letras',
            function () {
                $controlador = new EjerciciosController();
                $controlador->showMismasLetras();
            },
            'get'
        );

        Route::add(
            '/mismas-letras',
            function () {
                $controlador = new EjerciciosController();
                $controlador->doMismasLetras();
            },
            'post'
        );

        Route::add(
            '/demo-proveedores',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->demo();
            },
            'get'
        );
        Route::add(
            '/pob-pontevedra-form',
            function () {
                $controlador = new \Com\Daw2\Controllers\PobPontevControllerForm();
                $controlador->showPoblacionPontevedra();
            },
            'get'
        );
        Route::add(
            '/pob-pontevedra-form',
            function () {
                $controlador = new \Com\Daw2\Controllers\PobPontevControllerForm();
                $controlador->insertPoblacionPontevedraForm();
            },
            'post'
        );
        Route::add(
            '/pob-pontevedra',
            function () { 
                $controlador = new \Com\Daw2\Controllers\PobPontevController();
                $controlador->showPoblacionPontevedra();
            },
            'get'
        );
        Route::add(
            '/usuarios/new',
            function () {
                $controlador = new \Com\Daw2\Controllers\FormMVCController();
                $controlador->showFormMVC();
            },
            'get'
        );
        Route::add(
            '/usuarios/new',
            function () {
                $controlador = new \Com\Daw2\Controllers\FormMVCController();
                $controlador->insertFormMVC();
            },
            'post'
        );
        Route::add(
            '/test-model',
            function () {
                $controlador = new \Com\Daw2\Controllers\UsuarioController();
                $controlador->testConnect();
            },
            'get'
        );
        Route::add(
            '/users',
            function () {
                $controlador = new \Com\Daw2\Controllers\UsuarioController();
                $controlador->showUsers();
            },
            'get'
        );
        Route::add(
            '/users-bruto',
            function () {
                $controlador = new \Com\Daw2\Controllers\UsuarioController();
                $controlador->showUsersBruto();
            },
            'get'
        );
        Route::add(
            '/users-standard',
            function () {
                $controlador = new \Com\Daw2\Controllers\UsuarioController();
                $controlador->showUsersStandard();
            },
            'get'
        );
        Route::add(
            '/users-carlos',
            function () {
                $controlador = new \Com\Daw2\Controllers\UsuarioController();
                $controlador->showUsersCarlos();
            },
            'get'
        );
        Route::add(
            '/users-name',
            function () {
                $controlador = new \Com\Daw2\Controllers\UsuarioController();
                $controlador->showUsersByName();
            },
            'get'
        );
        Route::pathNotFound(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error404();
            }
        );

        Route::methodNotAllowed(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error405();
            }
        );
        Route::run();
    }
}
