<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectar a la bd
$db = conectarDB();

use Model\Principal;

Principal::setDB($db);