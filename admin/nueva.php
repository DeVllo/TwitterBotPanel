<?php
include('inc/header.php');
include('inc/navbar.php');


if(!IsAdmin($SESSION[6]))
{ 
                          echo '<script type="text/javascript">
                          function enviarAlerta(){
                            alert("No estás autorizado para ingresar a tal directorio.");
                            setTimeout("redireccion()", 1000);
                          }
                          setTimeout( "enviarAlerta()", 500);
                          function redireccion(){
                          window.location.href = "/";
                          }
                            
                          </script>';
                          die();
}


?>
<div id="content-wrapper" class="d-flex flex-column">

<script type="text/javascript">
    document.cookie = "pagina_ahora=Enviar frase";
</script>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Tablero</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
     <?php include('inc/infoCards.php'); ?>
    </div>

    <!-- Content Row -->

    <div class="row">


<!-- ASDFASDFASDF-->
<div class="col-xl-12 col-lg-5">
        <div class="card shadow mb-12">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Envíar nueva frase</h6>
            <div class="dropdown no-arrow">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Más opciones:</div>
                <a class="dropdown-item" href="http://dev.vainillastore.com/TwitterBot/anoth3rSearchTw33t.php">Ir al link original</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
          <!-- Card Body -->
          <div class="card-body">
              <?php
              if(isset($_POST['submitEnviar']))
              {
                    $error = 0;
                    $espacio = " ";
                    $frase_a_enviar = $_POST['fraseAEnviar'];
                    $frase_texto = $espacio.$frase_a_enviar;
                    $frase_autor = $_POST['quienLoEnvio'];
                    if(empty($frase_texto))
                    {
                    $html = '<script type="text/javascript">setTimeout(function () {swal("Error..", "Falta la frase a enviar.","error");}, 100); </script>';
                    $error = 1;
                    }
                    if(empty($frase_autor))
                    {
                        $frase_autor = "fumoporrobot";
                    }
                    if($error == 1)
                    {
                        echo '<script type="text/javascript">
                        function enviarSwal(){
                        swal("¡Error!", "¡Verifica bien si completaste la frase!","error");
                        }
                        setTimeout( "enviarSwal()", 1000);
                        </script>';
                        header('location: index.php');
                    }
                    else
                    {
                        $laQuery = "INSERT INTO `frases` (`ID`, `frase`, `autorizada`, `publicada`, `twitterID`, `autor`) VALUES (NULL, '$frase_texto', '1', '0', '420', '$frase_autor')";
                        $resultado = $con->query($laQuery);
                        
                        echo '<script type="text/javascript">
                        function enviarSwal(){
                        swal("¡Genial!", "Se agregó la frase: ' .$frase_texto.' ","success");
                        setTimeout( "redireccionar()", 3000);
                        }
                        setTimeout( "enviarSwal()", 1000);
                        function redireccionar(){
                        window.location.href = "writePhrase.php";
                        }
                        </script>';
                    }
              }
              ?>
            <form method="POST" action="">
  <div class="form-group">
    <label for="exampleInputEmail1"><b>Frase a envíar</b></label>
    <input type="text" class="form-control" name="fraseAEnviar" id="fraseAEnviar" aria-describedby="emailHelp" placeholder="cocino hamburguejas al vapor">
    <small id="emailHelp" class="form-text text-muted">Sólamente es la frase continua a "fumo porro".</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"><b>¿Quién lo envió?</b></label>
    <input type="text" class="form-control" name="quienLoEnvio" id="quienLoEnvio" placeholder="fumoporrobot">
  </div>
  <div class="text-center">
  <input type="submit" name="submitEnviar" class="btn btn-primary" value="Enviar">
  </div>
          </form>
          </div>
          
        </div>
      </div>
      </br></br>

      <!-- Escribir nueva frase. -->
    
        
      </div>
      <!-- ADFASDFASFASDFASDFSFDASFDA S   -->
    </div>
    </br>

    <!-- Content Row -->
   <div class="row">

      <!-- Content Column -->
 <div class="col-lg-6 mb-4">
     <div class="col-lg-6 mb-4">


        <div class="card shadow mb-4">

          <div class="card-body">
            <div class="text-center">
              <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
            </div>
            <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
            <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
          </div>
        </div> 



      </div> 
    </div> 

  </div>

</div> 
<!-- End of Main Content -->

<!-- Footer -->
<?php
include('inc/footer.php');
include('inc/scripts.php');
?>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<script src="js/sweetalert/sweetalert.init.js"></script>
<script src="js/sweetalert/sweetalert.min.js"></script>
</body>

</html>