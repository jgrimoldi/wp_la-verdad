<?php

session_start();

$connection = mysqli_connect("localhost", "root", "", "db_la-verdad");

if(!$connection){
    die("Error al conectar a la base de datos: <br>" . mysqli_connect_errno() . "-" . mysqli_connect_error());
}

// Set timezone: Argentina
date_default_timezone_set('America/Argentina/Rio_Gallegos');
// Physical address where config resides
define('ROOT_PATH', realpath(dirname(__FILE__)));
// Points to the root of the website
define('BASE_URL', 'http://localhost/wp_la-verdad/');