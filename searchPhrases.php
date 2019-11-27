<?php
session_start();
require_once("twitteroauth.php");
//include('configsqli.php');

include('inc/header.php');
include('inc/navbar.php');


if(!IsAdmin($SESSION[6]))
{ 
    echo("Acceso denegado.");
    header('location: /index.php');
    die();
}


//$mysqli = new mysqli($servername,$username,$password,$database);
//$mysqli->query("SET NAMES 'utf8'");
//if (mysqli_connect_errno()) {
//    printf("Connect failed: %s\n", mysqli_connect_error());
//    exit();
//}
 
$search = "#fumoporrobot OR #fumoporro";
$notweets = 100;
$consumerkey = "l3o04CbpPqeIuNHnjXpDJhWe0";
$consumersecret = "7o3SwLIQuFf8Q6QpFAjJOjorDuKX6JCx5Ucffr1LA2SbYlzqWS";
$accesstoken = "1155993504419631104-HnfJmeQs9RWZW6kNHyGUjYT4vdOZfb";
$accesstokensecret = "XUATR1Ex78hMc0rcZv4gx3WWPaFXtizgipk0HKmhfywhs";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$search = str_replace("#", "%23", $search);
$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=".$search."&count=".$notweets);
 
 
if ($stmt = $con->prepare("SELECT MAX(ID) FROM frases")) {
    $stmt->execute();
    $stmt->bind_result($max_tweetid);
    $stmt->fetch();
    $stmt->close();
}
$twitts = json_decode($tweets);
$aborrar = "#fumoporro";
$error = 0;
$frases = [];
foreach($twitts->statuses as $item)
{
    
    if( $item->id_str >$max_tweetid)
    {
        $originalstring = strtolower($item->text);
        $stringa = str_replace($aborrar, "", $item->text);
        $stringo = str_replace("bot","",$stringa);
        $frasefinal = str_replace("fumo porro", "", $stringo);
        
        $tweetID = (int)$item->id_str;
        
        $autorizada = 1;
        $publicada = 0;
        /* EXCEPCIONES EN LOS TWITTS NUEVA*/
        $search1 = 'http'; //Error 1.
        $search2 = 'RT @'; //Error 2.
        $search3 = 'sigo a'; //Error 3.
        $search4 = 'stan'; //Error 4.
        $search5 = 'stanneo'; //Error 5.
        $search6 = '@'; //Error 6.
        $search7 = '#'; //Error 7.
        $search8 = 'RT '; //Error 8.
        /*                          */
        if(preg_match("/{$search1}/i", $frasefinal))
        {
            $error = 1; //Error 1 => 'http'.
        }
        else if(preg_match("/{$search2}/i", $frasefinal))
        {
            $error = 2; //Error 2 => 'RT @'.
        }
        else if(preg_match("/{$search3}/i", $frasefinal))
        {
            $error = 3; //Error 3 => 'sigo a'.
        }
        else if(preg_match("/{$search4}/i", $frasefinal))
        {
            $error = 4; //Error 4 => 'stan'.
        }
        else if(preg_match("/{$search5}/i", $frasefinal))
        {
            $error = 5; //Error 5 => 'stanneo'.
        }
        else if(preg_match("/{$search6}/i", $frasefinal))
        {
            $error = 6; //Error 6 => '@'.
        }
        else if(preg_match("/{$search7}/i", $frasefinal))
        {
            $error = 7; //Error 7 => '#'.
        }
        else if(preg_match("/{$search8}/i", $frasefinal))
        {
            $error = 8; //Error 8 => 'RT'.
        }
        $autor = "@".$item->user->screen_name;

        if($error == 0)
        {

            if ($sisoniguales = $con->query("SELECT frase FROM frases WHERE frase = '$frasefinal'"))
            {
                $columnas_repetidas = $sisoniguales->num_rows;
                $sisoniguales->close();
            }

            if(!$columnas_repetidas > 0 )
            {
                //Cargar en base de datos.
                
                $stmt = $con->prepare("INSERT INTO frases (frase,autorizada,publicada,twitterID,autor) 
                VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param('siiis', 
                $frasefinal,
                $autorizada,
                $publicada,
                $tweetID,
                $autor);
                $stmt->execute(); 
                $stmt->close(); 
                echo("</br><h1 style='color:blue;'>Se acaba de agregar la frase: [fumo porro]+".$frasefinal." .</br>
                <p style='color:black'>Envíada por @".$item->user->screen_name."</p></br>");
                array_push($frases, $frasefinal);
                
                
            }
            else
            {
                echo("<h1 style='color:black;'>YA EXTISTE LA FRASE '".$frasefinal."'</h1>");
            }
		
        }
        else
        {
        //cuando ignora una frase:
        echo("<h1 style='color:red;'>SE IGNORÓ LA FRASE: '".$frasefinal."'</h1></br>
        <p style='color:black'>Envíada por @".$item->user->screen_name."</p></br>");
        //
        switch($error)
        {
            case 1:
            {
                echo("Por contener la frase: <p style='color:#732BF1;'>".$search1."</p></br>");
            }
            case 2:
            {
                echo("Por contener la frase: <p style='color:#732BF1;'>".$search2."</p></br>");
            }
            case 3:
            {
                echo("Por contener la frase: <p style='color:#732BF1;'>".$search3."</p></br>");
            }
            case 4:
            {
                echo("Por contener la frase: <p style='color:#732BF1;'>".$search4."</p></br>");
            }
            case 5:
            {
                echo("Por contener la frase: <p style='color:#732BF1;'>".$search5."</p>'</br>");
            }
            case 6:
            {
                echo("Por contener la frase: <p style='color:#732BF1;'>".$search6."</p></br>");
            }
            case 7:
            {
                echo("Por contener la frase: <p style='color:#732BF1;'>".$search7."</p></br>");
            }
            case 8:
            {
                echo("Por contener la frase: <p style='color:#732BF1;'>".$search8."</p></br>");
            }
        }
        
        //
        }
    }
    //no darle bola a esto.
    else
    {
        //echo("no lo supera :(");
        //echo($item->id_str);
    }

}
?>
<div id="content-wrapper" class="d-flex flex-column">



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


<!-- ASDFASDFASDF-->

      </br></br>

      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-7">
</div>
        
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