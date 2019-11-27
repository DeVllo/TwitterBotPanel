<?php
include('config.php');
session_start();

if(!isset($_SESSION['id'])){
    header("location: /login.php");
}

if(isset($_COOKIE['color_tema']))
{
    if(isset($_COOKIE['sidebar_toggled']))
    {
    $string_one = '<ul class="navbar-nav bg-gradient-'.$_COOKIE['color_tema'].' sidebar sidebar-dark accordion';
    
        if($_COOKIE['sidebar_toggled'] == "true")
        {
    //se pega la otra parte acá si está toggled:
            $string_one .= ' toggled" id="accordionSidebar">';
        }
        else if($_COOKIE['sidebar_toggled'] == "false")
        {
            $string_one .= ' " id="accordionSidebar">';
        }
        
        echo($string_one);
    }
}
else
{
    echo('<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">');
}
?>
<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://dev.vainillastore.com/">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">TwitterBot <sup>APP</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="http://dev.vainillastore.com/">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Escritorio</span></a>
</li>
<?php if(IsAdmin($SESSION[6])){ ?>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Admin
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Ajustes</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Custom Components:</h6>
      <a class="collapse-item" href="buttons.html">Buttons</a>
      <a class="collapse-item" href="cards.html">Cards</a>
    </div>
  </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Panel</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Utilidades:</h6>
      <a class="collapse-item" href="http://dev.vainillastore.com/admin/pormandar">→Frases a mandar</a>
      <a class="collapse-item" href="http://dev.vainillastore.com/admin/">→Administrar frases</a>
      <a class="collapse-item" href="/TwitterBot/anoth3SearchTw33t1.php">→Buscar frases</a>
      <a class="collapse-item" href="http://dev.vainillastore.com/admin/nueva">→Enviar frases</a>
    </div>
  </div>
</li>
<li class="nav-item">
  <a class="nav-link" href="https://analytics.twitter.com">
    <i class="fas fa-fw fa-chart-line"></i>
    <span>Analytics</span></a>
</li>
<?php }?>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  <?php 
 echo( getNombre($SESSION['1'], 1) );
  ?>
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-user"></i>
    <span>Mi cuenta</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Vista:</h6>
      <a class="collapse-item" href="login.php">Informacion del personaje</a>
      <a class="collapse-item" href="register.php">Informacion general</a>
      <a class="collapse-item" href="forgot-password.php">Biografía</a>
      <div class="collapse-divider"></div>
      <h6 class="collapse-header">Ajustes:</h6>
      <a class="collapse-item" href="#">Cambio de contraseña</a>
      <a class="collapse-item" href="#">Cambio de nombre</a>
      <a class="collapse-item" href="blank.html">Cambio de sexo</a>
    </div>
  </div>
</li>

<!-- Nav Item - Charts -->
<li class="nav-item">
  <a class="nav-link" href="/frases">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Frases por mandar</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
  <a class="nav-link" href="/masfrases">
    <i class="fas fa-fw fa-table"></i>
    <span>Todas las frases</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<!-- Color picker test -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePaint" aria-expanded="true" aria-controls="collapsePaint">
    <i class="fas fa-fw fa-paint-roller"></i>
    <span>Estilo</span>
  </a>
  <div id="collapsePaint" class="collapse" aria-labelledby="headingPaint" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Colores predeterminados:</h6>
      <a class="collapse-item bg-success" onclick="cambiarColor(1)"href="#"><i class="fas fa-fw fa-palette"></i> Predeterminado</a>
      <a class="collapse-item bg-info" onclick="cambiarColor(2)" href="#"><i class="fas fa-fw fa-palette"></i> Azul claro</a>
      <a class="collapse-item bg-primary" onclick="cambiarColor(3)" href="#"><i class="fas fa-fw fa-palette"></i> Azul oscuro</a>
      <a class="collapse-item bg-warning" onclick="cambiarColor(4)"href="#"><i class="fas fa-fw fa-palette"></i> Amarillo</a>
      <a class="collapse-item bg-danger" onclick="cambiarColor(5)" href="#"><i class="fas fa-fw fa-palette"></i> Rojo fuerte</a>
      <a class="collapse-item" onclick="cambiarColor(1)" href="#">Restablecer</a>
    </div>
  </div>
</li>
<!-- end Color picker -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button onclick="estadoSidebar()" class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
  <div class="modal-body">¿Estás seguro que deseas cerrar la sesión de tu usuario?</div>
  <div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
    <a class="btn btn-primary" href="../logout">Aceptar</a>
  </div>
</div>
</div>
</div>


<script>

var elSidebar = document.getElementById("accordionSidebar"),
        classe = 'toggled';
var sidebarOcultado = getCookie("sidebar_toggled");
var sidebarColor = getCookie("color_tema");

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function cambiarColor($opcion){
  var sidebar = document.getElementById("accordionSidebar");
  if($opcion == 1){
    //sidebar.className = "navbar-nav bg-gradient-success sidebar sidebar-dark accordion";
    document.cookie = "color_tema=success";
    if(sidebarOcultado == "true")
    {
        sidebar.className = "navbar-nav bg-gradient-success sidebar sidebar-dark accordion toggled";
    }
    else if(sidebarOcultado == "false")
    {
        sidebar.className = "navbar-nav bg-gradient-success sidebar sidebar-dark accordion";
    }
  }
  if($opcion == 2){
    //sidebar.className = "navbar-nav bg-gradient-info sidebar sidebar-dark accordion";
    document.cookie = "color_tema=info";
    if(sidebarOcultado == "true")
    {
        elSidebar.className = "navbar-nav bg-gradient-info sidebar sidebar-dark accordion toggled";
    }
    else if(sidebarOcultado == "false")
    {
        elSidebar.className = "navbar-nav bg-gradient-info sidebar sidebar-dark accordion";
    }
  }
  if($opcion == 3)
  {
    //sidebar.className = "navbar-nav bg-gradient-primary sidebar sidebar-dark accordion";
    document.cookie = "color_tema=primary";
    if(sidebarOcultado == "true")
    {
        elSidebar.className = "navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled";
    }
    else if(sidebarOcultado == "false")
    {
        elSidebar.className = "navbar-nav bg-gradient-primary sidebar sidebar-dark accordion";
    }
  }
  //
  if($opcion == 4){
    //sidebar.className = "navbar-nav bg-gradient-warning sidebar sidebar-dark accordion";
    document.cookie = "color_tema=warning";
    if(sidebarOcultado == "true")
    {
        elSidebar.className = "navbar-nav bg-gradient-warning sidebar sidebar-dark accordion toggled";
    }
    else if(sidebarOcultado == "false")
    {
        elSidebar.className = "navbar-nav bg-gradient-warning sidebar sidebar-dark accordion";
    }
}
  if($opcion == 5)
  {
    //sidebar.className = "navbar-nav bg-gradient-danger sidebar sidebar-dark accordion";
    document.cookie = "color_tema=danger";
    if(sidebarOcultado == "true")
    {
        elSidebar.className = "navbar-nav bg-gradient-danger sidebar sidebar-dark accordion toggled";
    }
    else if(sidebarOcultado == "false")
    {
        elSidebar.className = "navbar-nav bg-gradient-danger sidebar sidebar-dark accordion";
    }
}
}



function hasClass(element, className) {
    return (' ' + element.className + ' ').indexOf(' ' + className+ ' ') > -1;
}
function estadoSidebarCheck()
{
        //-------------
        var current_page = getCookie("pagina_ahora");
        var titulo_principal_element = document.getElementById("tituloPrincipal");
        var titlo_principal_content = titulo_principal_element.textContent;
        
        var titulo_titulo = "DeVApp | ";
        var titulo_subtitulo = current_page;
        var titulo_completo = titulo_titulo.concat(titulo_subtitulo);
        
        titulo_principal_element.innerHTML = titulo_completo;
        //-------------
        if (sidebarOcultado != "" && sidebarOcultado != null)
        {
            if(sidebarOcultado == "true")
            {
                elSidebar.className = "navbar-nav bg-gradient-"+ sidebarColor +" sidebar sidebar-dark accordion toggled";
            }
            else if(sidebarOcultado == "false")
            {
                elSidebar.className = "navbar-nav bg-gradient-"+ sidebarColor +" sidebar sidebar-dark accordion";
            }
        }
        else
        {
            if(hasClass(elSidebar, classe))
            {
                document.cookie = 'sidebar_toggled=true';
            }
            else
            {
                document.cookie = 'sidebar_toggled=false';
            }
        }
}

function estadoSidebar()
{
    var estadoSidebar = getCookie("sidebar_toggled");
    if(estadoSidebar == "true")
    {
         document.cookie = 'sidebar_toggled=false';
    }
    else
    {
        document.cookie = 'sidebar_toggled=true';
    }
}
</script>

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
      <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
          <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar usuarios..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <!-- Nav Item - Alerts -->
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <!-- Counter - Alerts -->
          <span class="badge badge-danger badge-counter">3+</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">
            Notificaciones
          </h6>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-primary">
                <i class="fas fa-file-alt text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">Hace 15 minutos</div>
              <span class="font-weight-bold">¡Usuario nuevo registrado desde la PCU!</span>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-success">
                <i class="fas fa-donate text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 7, 2019</div>
              Steven_Dominguez depositó $290.29 en tu cuenta número #54487712148.
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-warning">
                <i class="fas fa-exclamation-triangle text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 2, 2019</div>
              Spending Alert: We've noticed unusually high spending for your account.
            </div>
          </a>
          <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div>
      </li>

      <!-- Nav Item - Messages -->
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-palette fa-fw"></i>
          <!-- Counter - Messages -->
          <span class="badge badge-danger badge-counter">♥</span>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
          <h6 class="dropdown-header">
            Cambiar color de tema
          </h6>
          <a class="dropdown-item d-flex align-items-center bg-success" onclick="cambiarColor(1)" href="#">
            <div class="dropdown-list-image mr-3">
              <!--<img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
              <div class="status-indicator bg-success"></div> -->
            </div>
            <div class="font-weight-bold">
              <div class="text-truncate bg-success">Color verde claro - "Success"</div>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center bg-info" onclick="cambiarColor(2)" href="#">
            <div class="dropdown-list-image mr-3">
              <!-- <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
              <div class="status-indicator"></div> -->
            </div>
            <div>
              <div class="text-truncate">Color azul claro - "Info"</div>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center bg-primary" onclick="cambiarColor(3)" href="#">
            <div class="dropdown-list-image mr-3">
              <!-- <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
              <div class="status-indicator bg-warning"></div> -->
            </div>
            <div>
              <div class="text-truncate">Color azul oscuro - "Primary"</div>
              <!-- <div class="small text-gray-500">Morgan Alvarez · 2d</div> -->
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
              <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
              <div class="status-indicator bg-success"></div>
            </div>
            <div>
              <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
              <div class="small text-gray-500">Chicken the Dog · 2w</div>
            </div>
          </a>
          <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
        </div>
      </li>

      <div class="topbar-divider d-none d-sm-block"></div>
    <!-- INIC -->
    <!--
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          
          <span class="badge badge-danger badge-counter">7</span>
        </a>
        
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
          <h6 class="dropdown-header">
            Cambiar color de tema
          </h6>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
              <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
              <div class="status-indicator bg-success"></div>
            </div>
            <div class="font-weight-bold">
              <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
              <div class="small text-gray-500">Emily Fowler · 58m</div>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
              <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
              <div class="status-indicator"></div>
            </div>
            <div>
              <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
              <div class="small text-gray-500">Jae Chun · 1d</div>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
              <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
              <div class="status-indicator bg-warning"></div>
            </div>
            <div>
              <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
              <div class="small text-gray-500">Morgan Alvarez · 2d</div>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
              <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
              <div class="status-indicator bg-success"></div>
            </div>
            <div>
              <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
              <div class="small text-gray-500">Chicken the Dog · 2w</div>
            </div>
          </a>
          <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
        </div>
      </li>

      <div class="topbar-divider d-none d-sm-block"></div>
      -->
    <!-- FINISH BACKUP MESSAGES  -->

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-grey-600 small"><b><?=$SESSION['1']?></b></span>
          <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Perfil
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Ajustes
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Registro de actividades
          </a>
      
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Cerrar sesión
          </a>
        </div>
      </li>

    </ul>

  </nav>
  <!-- End of Topbar -->