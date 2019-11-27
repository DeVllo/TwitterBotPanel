<!DOCTYPE html>
<html lang="en">
<?php
include('inc/config.php');
include('inc/funcs.php');
session_start();
$key = $_SESSION['id'];

if(isset($key)){
header('location: /');
}
?>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TwBotApp- Registro</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/sweetalert/sweetalert.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="img/favicon.png">


</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">¡Crea tu cuenta!</h1>
              </div>
              <?php
                
                //$activationKey = genera_random(20); 
                $activationKey = md5($email.time()); // encrypted email+timestamp

              
              if(isset($_POST['registrarBtn'])){
                $name = mysqli_real_escape_string($con, $_POST['nombre']);
                //$surname = mysqli_real_escape_string($con, $_POST['apellido']);
                $password = mysqli_real_escape_string($con, md5($_POST['contrasena'])); 
                $password2 = mysqli_real_escape_string($con, md5($_POST['contrasena2']));
                $email = mysqli_real_escape_string($con, $_POST['correo']);
                
                $sexo = mysqli_real_escape_string($con, $_POST['sexo']);
                $ip = $_SERVER['REMOTE_ADDR'];
               /* -------------------------- */
               //----------Check if 2 mail exist -----------//
               $checkMail = "SELECT * FROM cuentas WHERE email = '$email'";
               $asd1 = $con->query($checkMail);
               $mail_cnt = mysqli_num_rows($asd1);
               //------------------------------------------------------
                $log1n = "SELECT * FROM cuentas WHERE nombre='$name'";
                $eeee = $con->query($log1n);
                $row_cnt = mysqli_num_rows($eeee);


                function enviarMail()
                {
                    
                
                //Fin function enviarMail();
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $html = '<script type="text/javascript">setTimeout(function () {swal("Oops...", "Email invalido.","error");}, 1); </script>';
                  $error = 1;
                }

                if($mail_cnt > 0)
                {
                    $html = '<script type="text/javascript">setTimeout(function () {swal("Oops...", "¡Ya existe una cuenta con ese correo!.","error");}, 100); </script>';
                    $error = 1; 
                }

                if(strlen($name) > 20){
                  $html = '<script type="text/javascript">setTimeout(function () {swal("Oops...", "El nombre de usuario debe tener maximo 20 caracteres.","error");}, 100); </script>';
                  $error = 1;
                }

                if(strlen($name) < 5){
                  $html = '<script type="text/javascript">setTimeout(function () {swal("Oops...", "El nombre de usuario debe tener mínimo 5 carácteres.","error");}, 100); </script>';
                  $error = 1;
                }

                if($row_cnt >= 1){
                  $html = '<script type="text/javascript">setTimeout(function () {swal("Oops...", "Ya existe una cuenta con ese nombre de usuario.","error");}, 100); </script>';
                  $error = 1;
                }

                if (!preg_match("/^[a-zA-Z]/", $name))
                {
                  $html = '<script type="text/javascript">setTimeout(function () {swal("Oops...", "El nombre de usuario solo puede contener caracteres válidos.","error");}, 100); </script>';
	                $error = 1;
                }

                if($password != $password2){
                  $html = '<script type="text/javascript">setTimeout(function () {swal("Oops...", "Las contraseñas no coinciden.","error");}, 100); </script>';
                  $error = 1;
                }

                if( empty($name) OR empty($sexo) OR empty($email) OR empty($password) OR empty($password2))
                {
                  $html = '<script type="text/javascript">setTimeout(function () {swal("Oops...", "¡Revisa bien! Faltan datos.","error");}, 100); </script>';
                  $error = 1;
                }

                $recaptcha = $_POST["g-recaptcha-response"];

                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $data = array(
                  'secret' => '6Lfg5rIUAAAAADO5S8frREsvkAdwXjTiBUqYDbec',
                  'response' => $recaptcha
                );
                
                $options = array(
                'http' => array (
                'method' => 'POST',
                'content' => http_build_query($data)));

                if(empty($recaptcha)){
                  $html = '<script type="text/javascript">setTimeout(function () {swal("Oops...", "¡Demuestranos que no eres un robot!","error");}, 100); </script>';
                  $error = 1;
                }
                
                if($error == 1){
                  echo $html;
                }
                else{
                  if ($con->query("INSERT INTO cuentas (username, password, email, genero, ip, admin, activada, activationKey) VALUES ('$name', '$password', '$email', '$sexo', '$ip', '0', '0', '$activationKey')") === TRUE) {	

                    $ch3ck = "SELECT * FROM cuentas WHERE username='$name'";
                    $checkk = $con->query($ch3ck);
                    $check = $checkk->fetch_row();
                    $newID = $check[0];
                    enviarMail();
                    $_SESSION['id_temp'] = $newID;
                    $_SESSION['email'] = $email;
                    /* =========[ correo ] ========= */
                    
                    $ide = $_SESSION['temp_id'];
                    $path="http://dev.vainillastore.com/"; //creamos nuestra direccion, con las carpetas que sean si hay
                    //armamos nuestro link para enviar por mail en la variable $activateLink
                    $activateLink = $path."cregistro.php?id=".$newID."&activationKey=".$activationKey."";
                
                          // Datos del email

$mailto = $email;
$fromName = "TwitterBotApp - Registro";
$mailsubject = '[Registro] TwBot - Confirme su cuenta:';
$from = 'info@vainillastore.com';
// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
$headers .= 'Cc: info@vainillastore.com' . "\r\n"; 
$headers .= 'Bcc: info@vainillastore.com' . "\r\n";

        $htmlContent = '<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <style>
    @media only screen and (max-width: 620px) {
      table[class=body] h1 {
        font-size: 28px !important;
        margin-bottom: 10px !important;
      }
      table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
        font-size: 16px !important;
      }
      table[class=body] .wrapper,
            table[class=body] .article {
        padding: 10px !important;
      }
      table[class=body] .content {
        padding: 0 !important;
      }
      table[class=body] .container {
        padding: 0 !important;
        width: 100% !important;
      }
      table[class=body] .main {
        border-left-width: 0 !important;
        border-radius: 0 !important;
        border-right-width: 0 !important;
      }
      table[class=body] .btn table {
        width: 100% !important;
      }
      table[class=body] .btn a {
        width: 100% !important;
      }
      table[class=body] .img-responsive {
        height: auto !important;
        max-width: 100% !important;
        width: auto !important;
      }
    }
    @media all {
      .ExternalClass {
        width: 100%;
      }
      .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
        line-height: 100%;
      }
      .apple-link a {
        color: inherit !important;
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-decoration: none !important;
      }
      #MessageViewBody a {
        color: inherit;
        text-decoration: none;
        font-size: inherit;
        font-family: inherit;
        font-weight: inherit;
        line-height: inherit;
      }
      .btn-primary table td:hover {
        background-color: #34495e !important;
      }
      .btn-primary a:hover {
        background-color: #34495e !important;
        border-color: #34495e !important;
      }
    }
    </style>
  </head>
  <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
          <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
            <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hola <strong>'.$name.'</strong></p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hemos recibido el registro de su cuenta, pero falta un último paso para que obtenga el acceso total a la página.</br>
                            Clickea el siguiente botón para dirigírte a la autenticación y confirmación de tu correo y asegurarnos que en verdad eres '.$name.'.</p>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                          <tbody>
                            <tr>
                              <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                  <tbody>
                                    <tr>
                                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"> <a href="'.$activateLink.'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Confirmar registro</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Si no fuiste tú quien creó la cuenta, ni estás relacionado con DeVApp, no confirmes ni clickees el botón. ¡Podrían estar haciendose pasar por vos!</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">¡Un saludo! ¡Te deseamos una excelente estadía!.</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
              <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                <tr>
                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">DeVSign/DeVApp, Development & Web Design, Argentina.</span>
                    <br> ¿No fuiste vos quien creó la cuenta? <a href="http://devsign.net/We" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">¡Informános!</a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                    Creado y dirigido por: <a href="https://twitter.com/tostad0r" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">DeVllo/tostad0r</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>';
        //-------------------

 
if(mail($mailto, $mailsubject, $htmlContent, $headers)){
    echo '<script type="text/javascript">
                          function enviarSwal(){
                            swal("¡Genial!", "Sólo queda un último paso. Ingresa a tu casilla de correo para confirmar tu usuario :)","success");
                            
                          }
                          setTimeout( "enviarSwal()", 1000);
                          function redireccion(){
                          window.location.href = "/";
                          }
                          document.cookie = "color_tema=success";
                            
                          </script>';
} else{
    echo 'Unable to send email. Please try again.';
}
                    
                    /* =========[ correo ] ========= */
                  }
                }

              }
              ?>
              <form class="user" method="POST">
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <input type="text" name="nombre" class="form-control form-control-user" id="exampleFirstName" placeholder="Nombre de usuario">
                  </div>
                  <!--
                  <div class="col-sm-6">
                    <input type="text" name="apellido" class="form-control form-control-user" id="exampleLastName" placeholder="Apellido">
                  </div>-->
                </div>
                <div class="form-group">
                <label for="sexo"> Selecciona tu género: </label>
                  <select name="sexo" class="form-control" id="">
                    <option value="1"> Masculino </option>
                    <option value="2"> Femenino </option>
                    <option value="3"> Prefiero no decirlo</option>
                  </select>
                </div>
                <!--
                <div class="form-group">
                  <div class="input-group">
                  <input type="date" class="form-control form-control-user text-center" max="2001-01-01" value="<?php //echo $minfechaparalaedad; ?>" name="nacimiento">
                  </div>
                </div> -->
                <div class="form-group">
                  <input type="email" name="correo" class="form-control form-control-user text-center" id="exampleInputEmail" placeholder="correo@ejemplo.com">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="contrasena" class="form-control form-control-user" id="exampleInputPassword" placeholder="Contraseña">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="contrasena2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repite la contraseña">
                  </div>
                </div>
                
                <div class="form-group" style="text-align: center;">
                    <center><div class="g-recaptcha" data-sitekey="6Lfg5rIUAAAAAPH6wq3MOWio4Tso_CeNs9HvCwnY"></div> </center>
                    </div>

                <input type="submit" name="registrarBtn" class="btn btn-primary btn-user btn-block" value="Registrar">
                
                <hr>
                <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Registrar con Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Registrar con Facebook
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="olvidelacontra.php">¡Olvidaste tu clave?</a>
              </div>
              <div class="text-center">
                <a class="small" href="/login">¿Ya tienes una cuenta? ¡Ingresá!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


  <script src="js/sweetalert/sweetalert.init.js"></script>
  <script src="js/sweetalert/sweetalert.min.js"></script>
  <?php
  include('inc/scripts.php');
  ?>

</body>

</html>
