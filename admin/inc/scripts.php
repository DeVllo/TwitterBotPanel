<!-- Bootstrap core JavaScript-->
<script src="http://dev.vainillastore.com/vendor/jquery/jquery.min.js"></script>
<script src="http://dev.vainillastore.com/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="http://dev.vainillastore.com/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="http://dev.vainillastore.com/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="http://dev.vainillastore.com/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="http://dev.vainillastore.com/js/demo/chart-area-demo.js"></script>
<script src="http://dev.vainillastore.com/js/demo/chart-pie-demo.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="http://dev.vainillastore.com/js/sweetalert/sweetalert.init.js"></script>
<script src="https://use.fontawesome.com/850ddbc6c9.js"></script>

<script type="text/javascript">

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

        var current_page = getCookie("pagina_ahora");
        var url = window.location.pathname;
        var filename = url.substring(url.lastIndexOf('/')+1);
        //alert(filename);
        var titulo_principal_element = document.getElementById("tituloPrincipal");
        var titlo_principal_content = titulo_principal_element.textContent;
        
        var titulo_titulo = "DeVApp | ";
        var titulo_subtitulo = current_page;
        var titulo_completo = titulo_titulo.concat(titulo_subtitulo);
        ///////////////////////////////////////////////////////////////
        var titulo_viejo = document.getElementsByTagName("title")[0].textContent;
        var titulo_a_cambiar = document.getElementsByTagName("title")[0];
        //titulo.innerHTML = 'No te vayas :(( ';
        window.onblur = function () { titulo_a_cambiar.innerHTML = 'No te vayas :(('; }
        window.onfocus = function() { titulo_a_cambiar.innerHTML = titulo_completo; }
</script>
