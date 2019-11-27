var outer = document.querySelector('.outer-path'),  
    inner = document.querySelector('.inner-path'),
	success = document.querySelector('.success-path'),
  error = document.querySelector('.error-path'),
  error2 = document.querySelector('.error-path2');
var outerCircle, innerCircle, successSegment, errorSegment, errorSegment2;
var textoInfo = document.getElementById("p-info");
var textoInfo2 = document.getElementById("p-info2");
var tituloInfo = document.getElementById("tituloInfo");
var successAnimation = function() { 
    successSegment.set(
      {
        start: '60%',
        end: '100%',
        duration: 0.4
      });
}
errorAnimation = function(){
    
    errorSegment.set({
      start: '60%', 
      end: '100%',
      duration: 0.4
    });
    errorSegment2.set({
      start: '65%',
      end: '100%',
      duration: 0.4
    });
};
var succeed = false; 
var err = false;
var triggerError = function(){
    err = true;
}
var triggerSuccess = function(){
    succeed = true;
}
function outerAnimation() {
	outerCircle.set({
    start: '15%',
    end: '25%',
    duration: 0.2,
    callback: function() {
      outerCircle.set({   
        start: '75%',
        end: '150%',
        duration: 0.3,  
        follow: true,
        callback: function() { 
          outerCircle.set({
            start: '70%',
            end: '75%',
            duration: 0.3,
            callback: function() {
              outerCircle.set({
                start: '100%',
                end: '100.1%',
                duration: 0.4,
                follow: true,
                callback: function() {
                  if(succeed == true) {
                    success.style.visibility = 'visible';
                    outer.style.visibility = 'hidden';
                    inner.style.visibility = 'hidden';
                    successAnimation();
                  }
                  else if (err == true) {
                    error.style.visibility = 'visible';
                    error2.style.visibility = 'visible';
                    outer.style.visibility = 'hidden';
                    inner.style.visibility = 'hidden';
                    errorAnimation();
                  }
                  else {
                  	outerAnimation();
                  	innerAnimation();  
                  }
                  
                }
              })
            }
          }); 
        }
      });    
    }
  }); 
}
function innerAnimation(){  
    innerCircle.set(
      {
        start: '20%',
        end: '80%',
        duration: 0.6,
        callback: function() {
          innerCircle.set({
            start: '100%',
            end: '100.1%',
            duration: 0.6,
            follow: true
          });
        }
      }
    );
}
function reset() {
  success.style.visibility = 'hidden';
  error.style.visibility = 'hidden';
  error2.style.visibility = 'hidden';
  succeed = false; 
	err = false;
  successSegment = new Moveit(success, {
   	start: '0%',
    end: '0.1%'
  });
  errorSegment = new Moveit(error, {
    start: '0%',
    end: '0.1%'
  });
  errorSegment2 = new Moveit(error2, {
    start: '0%',
    end: '0.1%'
  });
  
  outerCircle = new Moveit(outer, {
      start: '0%',
      end: '0.1%'
  });
  innerCircle = new Moveit(inner, {
      start: '0%',
      end: '0.1%'
  });
  outer.style.visibility = 'visible';
	inner.style.visibility = 'visible';
  setTimeout(function() {
  	outerAnimation(); 
		innerAnimation();  
  });
  
  
  
}

function validarPrimero()
{
  reset();
  document.querySelector('svg').style.visibility = 'visible';
}

function mostrarSuccess()
{
    triggerSuccess();
    outerAnimation();
    textoInfo.innerHTML = "¡Genial! Tu cuenta fué creada con éxito &#128526;";
    tituloInfo.innerHTML = "DeVApp - ¡Registro completo! &#128526;";
    
    setTimeout(textoRedireccionar, 1000);
}

function textoRedireccionar()
{
    var textoInfo2 = document.getElementById("p-info2");
    textoInfo2.innerHTML = "Lo estamos llevando a la página de ingreso";
    setTimeout(textoRedireccionar1, 1000);
}
function textoRedireccionar1()
{

    textoInfo2.innerHTML = "Lo estamos llevando a la página de ingreso.";
    setTimeout(textoRedireccionar2, 1000);
}
function textoRedireccionar2()
{
    
    textoInfo2.innerHTML = "Lo estamos llevando a la página de ingreso..";
    setTimeout(textoRedireccionar3,1000)
    reset();
}
function textoRedireccionar3()
{
    textoInfo2.innerHTML = "Lo estamos llevando a la página de ingreso...";
    setTimeout(redireccionar,1000);
}

function redireccionar()
{
    window.location.href = "/";
}
function mostrarError()
{
    triggerError();
    outerAnimation();
    textoInfo.innerHTML = "¡Error! Hubo un error en la confirmación de tu cuenta &#128532;</br>¡Verifica el mail y solicita una apelación mediante nuestro soporte!";
    tituloInfo.innerHTML = "DeVApp - Error &#128532;";
}