<?php

session_start();

$connection = mysqli_connect("localhost", "root", "", "db_la-verdad");

if(!$connection){
    die("Error al conectar a la base de datos: <br>" . mysqli_connect_errno() . "-" . mysqli_connect_error());
}

// Set locale in Spanish
setlocale(LC_ALL, array("es_RA.UTF-8", "es_ES"));
// Set timezone: Argentina
date_default_timezone_set('America/Argentina/Mendoza');
// Physical address where config resides
define('ROOT_PATH', realpath(dirname(__FILE__)));
// Points to the root of the website
define('BASE_URL', 'http://localhost/wp_la-verdad/');
// Social networks
define('FACEBOOK_URL', 'https://facebook.com/LaVerdad-109301787920924');
define('TWITTER_URL', 'https://twitter.com/');
define('INSTAGRAM_URL', 'https://instagram.com/');
