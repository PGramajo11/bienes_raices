<?php

namespace Controllers;
use MVC\Router;

class PropiedadController
{
    //render desde el router para el html
    public static function index(Router $router)
    {
        $router->render('propiedades/admin');
    }

    public static function crear()
    {

    }

    public static function actualizar()
    {

    }

}