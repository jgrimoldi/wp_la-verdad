<!DOCTYPE html>
<html lang="es">

<head>
    <!-- ============== meta ============== -->
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="author" content="JG">
   <meta name="description" content="La Verdad noticias en Vivo, enterate las últimas novedades de la ciudad de Río Negro. Opiniones, Musica, Deportes y mucho más todo al alcance de un click. Toda la actualidad en un solo lugar.">
   <meta name="keywords" content="La Verdad, Noticias, Río Negro, En Vivo, Actualidad, Empleos, Guia, Búsquedas, Clasificados, Datos del Día, <?php echo date('d-m-y') ?> ">
   <meta name="robots" content="index, follow">
   <link rel="canonical" href="<?php echo BASE_URL ?>/">
   <meta property="og:image" content="<?php echo BASE_URL . 'static/img/favicon/favicon-192x192.png' ?>">
   <meta property="og:image:secure_url" content="<?php echo BASE_URL . 'static/img/favicon/favicon-192x192.png' ?>">
   <meta property="og:image:type" content="image/svg">
   <meta property="og:image:width" content="192">
   <meta property="og:image:height" content="192">
   <meta property="og:image:alt" content="La Verdad Logotipo">
   <meta property="og:locale" content="es_AR">
   <meta property="og:locale:alternate" content="es_LA">
   <meta property="og:type" content="article">
   <meta property="og:title" content="La Verdad">
   <meta property="og:description" content="La Verdad noticias en Vivo, enterate las últimas novedades de la ciudad de Río Negro. Opiniones, Musica, Deportes y mucho más todo al alcance de un click. Toda la actualidad en un solo lugar.">
   <meta property="og:url" content="<?php echo BASE_URL ?>">
   <meta property="og:site_name" content="LV">
   <!-- ============== favicon ============== -->
    <?php include(ROOT_PATH . '/includes/favicon.php') ?>
    
   <!-- ============== css ============== -->
   <link rel="stylesheet" href="./static/css/base.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
   <link rel="preload" href="./static/css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
   <link rel="preload" href="./static/css/mobile.css" as="style" media="(max-width: 968px)" onload="this.onload=null;this.rel='stylesheet'">

   <!-- ============== fonts ============== -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&amp;display=swap" as="style" onload="this.onload=null; this.rel='stylesheet'">

   <!-- ============== noscript ============== -->
   <noscript>
       <link rel="stylesheet" href="./static/css/base.css">
       <link rel="stylesheet" href="./static/css/style.css">
       <link rel="stylesheet" href="./static/css/responsive.css">
       <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
   </noscript>