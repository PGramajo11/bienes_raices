<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {

        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propieades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propieades
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/propiedades');

        //buscar la propiedad por su id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);

    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];

            $mail = new PHPMailer();

            //configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'live.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'api';
            $mail->Password = 'c201d1cddded9df4d8aae864ed92b82a';
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';

            //configurar contenido
            $mail->setFrom('info@demomailtrap.co');
            $mail->addAddress('pdgx13@gmail.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir conetenido
            $contenido = '<html>';
            $contenido .= '<p> Tienes un nuevo mensaje </p>';
            $contenido .= '<p> Nombre: ' . $respuestas['nombre'] . ' </p>';
            $contenido .= '<p> Correo: ' . $respuestas['email'] . ' </p>';
            $contenido .= '<p> Teléfono: ' . $respuestas['telefono'] . ' </p>';
            $contenido .= '<p> Mensaje: ' . $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p> Vende o Compra: ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p> Precio o Presupuesto: Q' . $respuestas['precio'] . ' </p>';
            $contenido .= '<p> Prefiere ser contactado por: ' . $respuestas['contacto'] . ' </p>';
            $contenido .= '<p> Fecha Contacto: ' . $respuestas['fecha'] . ' </p>';
            $contenido .= '<p> Hora de Contacto: ' . $respuestas['hora'] . ' </p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin html';

            if ($mail->send()) {
                echo "Mensaje enviado correctamente";
            } else {
                echo "El mensaje no fue enviado";
            }

        }

        $router->render('paginas/contacto', [

        ]);
    }
}