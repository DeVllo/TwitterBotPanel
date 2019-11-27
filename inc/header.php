<?php
include('inc/config.php');
include('inc/config_frases.php');
include('inc/funcs.php');
session_start();
$key = $_SESSION['id'];
unset($_COOKIE['id']);
$llavesita = md5($key);
$laquerysita = "SELECT * FROM cuentas WHERE ID ='$key'";


$SESS1ON = $con->query($laquerysita);
$SESSION = $SESS1ON->fetch_row();

if(!isset($key))
{
header('location: /login');
session_destroy();
}
else
{
  unset($_COOKIE ['id']);
  unset($_COOKIE['nombre']);
  //$_SESSION['id'] = $key;
  //$_SESSION['nombre'] = $_COOKIE['nombre'];
}


//

function mostrarCuenta($ID, $valor)
    {
        switch($valor)
        {
            case "ID":
            {
                $devolver = $SESSION['0']; 
            }
            case "username":
            {
                $devolver = $SESSION['1']; 
            }
            case "password":
            {
                $devolver = $SESSION['2']; 
            }
            case "email":
            {
                $devolver = $SESSION['3']; 
            }
            case "genero":
            {
                $devolver = $SESSION['4'];        
            }
            case "ip":
            {
                $devolver = $SESSION['5'];
            }
            case "admin":
            {
            $devolver = $SESSION['6'];
            }
        }
        return $devolver;
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title id="tituloPrincipal">DeVApp - Cargando...</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="http://dev.vainillastore.com/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="http://dev.vainillastore.com/css/sweetalert/sweetalert.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="img/favicon.png">

</head>

<body id="page-top" onload="estadoSidebarCheck()">

  <!-- Page Wrapper -->
  <div id="wrapper">