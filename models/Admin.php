<?php

namespace Model;

class Admin extends Principal
{

    //base de datos
    protected static $tabla = 'usuario';
    protected static $columnasDB = ['id' . 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

}