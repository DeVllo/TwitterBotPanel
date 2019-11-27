<?php
include('inc/header.php');
include('inc/navbar.php');

/*
if(!IsAdmin($SESSION[6]))
{ 
    echo("Acceso denegado.");
    header('location: /index.php');
    die();
}
*/

?>
<div id="content-wrapper" class="d-flex flex-column">

<script type="text/javascript">
    document.cookie = "pagina_ahora=Frases a envíar";
</script>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Tablero</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Descargar PDF</a>
    </div>

    <!-- Content Row -->
    <div class="row">
     <?php include('inc/infoCards.php'); ?>
    </div>

    <!-- Content Row -->

    <div class="row">



      </br></br>

      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-7">
        
        <?php $result = mysqli_query($con,"SELECT * FROM frases WHERE publicada = 0 AND autorizada = 1"); ?>
        <div class="card shadow mb-12">
    <div class="table-responsive">   
        <!-- Trying to do CRUD -->
        
    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Frase</th>
      <th scope="col">Autor</th>
    </tr>
  </thead>
  <tbody>
    <!-- -->
    <?php
    while($row = mysqli_fetch_array($result))
{
    $conlink = '<a target="_blank" href="https://twitter.com/'.$row['autor'].'">'.$row['autor'].'</a>';
echo "<tr>";
echo "<th scope='row'>".$row['ID']."</th>";
echo "<td>" . $row['frase'] . "</td>";
echo "<td>" . $conlink . "</td>";
echo "</tr>";
}
?>
<!-- -->
  </tbody>
</table>
</div>
</div>
        
      </div>

<?php $laspublicadas = mysqli_query($con,"SELECT MAX(ID) FROM frases WHERE publicada = 1"); 

?>
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
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->


</body>

</html>