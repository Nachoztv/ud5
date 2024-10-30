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
