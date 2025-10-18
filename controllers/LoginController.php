<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if (empty($errores)) {

                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    //verificar si el usuario existe
                    $errores = Admin::getErrores();
                } else {
                    //verificar la contraseña
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        //autenticar
                        $auth->autenticar();
                    } else {
                        $errores = Admin::getErrores();
                    }


                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location: /');

    }

}