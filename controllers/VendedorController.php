<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController
{
    public static function crear(Router $router)
    {
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            //validar que no haya campos vacios
            $errores = $vendedor->validar();

            //Si no hay errores
            if (empty($errores)) {
                $vendedor->guardar();
            }

        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = Vendedor::getErrores();
        $id = validarORedireccionar('/admin');

        //obtener datos del vendedor a actualizar
        $vendedor = Vendedor::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //asignar nuevos valores
            $args = $_POST['vendedor'];

            $vendedor->sincronizar($args);

            //validar nuevos campos
            $errores = $vendedor->validar();

            //guardar
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }


        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);

    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $tipo = $_POST['tipo'];

                if (validarContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }

    }
}