<?php
include('inc/config.php');
include('inc/funcs.php');
session_start();
?>

<html>
    <head>
<link href="css/sweetalert/sweetalert.css" rel="stylesheet">
        
        <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title id="tituloInfo">DeVApp - Cargando...</title>

  <!-- Custom fonts for this template-->
  <link href="css/cregistro.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom styles for this template-->
  <link rel="icon" type="image/png" href="img/favicon.png">
    </head>
    <body onload="validarPrimero()">
        <!--
        -->
        <!-- <header class="masthead">
        -->
        <div class="masthead">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12 text-center">
            <!-- -->
            <div class="movidoIzquierda">     
            <svg width="120" height="120">
    <path class="outer-path" stroke="#fff" d="M 60 60 m 0 -50 a 50 50 0 1 1 0 100 a 50 50 0 1 1 0 -100"></path>   
    <path class="inner-path" stroke="rgba(255, 255, 255, 0.5)" d="M 60 60 m 0 -30 a 30 30 0 1 1 0 60 a 30 30 0 1 1 0 -60"></path>
    <path class="success-path" stroke="#00ff2a" d="M 60 10 A 50 50 0 0 1 91 21 L 75 45 L 55 75 L 45 65"></path> 
    <path class="error-path" stroke="#d30000" d="M 60 10 A 50 50 0 0 1 95 25 L 45 75"></path>
    <path class="error-path2" stroke="#d30000" d="M 60 30 A 30 30 0 0 1 81 81 L 45 45"></path>
    </svg>
</div>
            <p class="lead" id="p-info"></p>
            </br></br>
            <p class="lead" id="p-info2"></p>
      </div>
    </div>
  </div>
  </div>
<!--</header>
-->

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
        <script type="text/javascript" src="js/cregistro.js"></script>
        <script type="text/javascript" src="https://kodhus.com/moveit.0.4.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
    </body>
    <style>
    .body{
         width: 100%;
         height: 100%;
         padding: 0;
         margin: 0;
         line-height: 0;
    }
    .movidoIzquierda
    {
        /*right: 50%;*/
    }
    .masthead {
  width:100%;
  height:100%;
  
  background: #005aa7;
  background: -webkit-linear-gradient(to right, #005aa7, #fffde4);
  background: linear-gradient(to right, #005aa7, #fffde4); 
  background-position: absolute;
}
    </style>
    
</html>

<?php

if (isset($_GET['id']))
{

    if(isset($_GET['activationKey']))
    {
    $idval= $_GET['id'];
    $activate2= $_GET['activationKey'];  
    
    //$querysita = "UPDATE cuentas SET activada = 1 WHERE activationKey = '$activate2'";
    //$asd1 = $con->query($querysita);
    
    $queryCheck = "SELECT activada FROM cuentas WHERE activationKey = '$activate2'";
    $checkear = $con->query($queryCheck);
    if (!$checkear) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
    }
    $row = mysql_fetch_row($checkear);
    if($row == 1)
    {
        echo('<script>console.log("re bien el pibe, autorizado... ");</script>');
    }
    else
    {
         echo('<script>console.log("re mal el pibe, no autorizado... ");</script>');
    }
    //
    
    
       /* if($asd1 == TRUE)
        {
            echo("<script>
            setTimeout(mostrarSuccess, 3000);
            </script>");
        }
        else
        {
            echo("<script>
            setTimeout(mostrarError, 3000);
            </script>");
        }
        */
    }
    else
    {
        echo("<script>
            setTimeout(mostrarError, 3000);
            </script>");
    }
}   
else
{   
    echo("<script>
            setTimeout(mostrarError, 3000);
            </script>");
}
    
?>