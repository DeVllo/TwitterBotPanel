<?php
include('config.php');
session_start();

$ids = "";

if(isset($_POST['desautorizar']) && count($_POST['no']>0))
{

    for($i=0;$i<count($_POST['no']);$i++)
    {
        $row_no=$_POST['no'][$i];
        $resultaque = mysqli_query($con, "UPDATE frases SET `autorizada`= '0' WHERE `ID`= '$row_no'");
        if($i == 0){
        $ids .= $row_no;    
        }
        else{
        $ids .= ", ".$row_no;    
        }
        
    }
    if($resultaque)
    {
        $_SESSION['message'] = "Frase/s id(s): ".$ids." desautorizados!"; 
        $_SESSION['tipo_mensaje'] = "desautorizar";
	    header('location: ../admin_frases.php');
    }
        
}
    if(isset($_POST['eliminar']) && count($_POST['no']>0))
    {
        for($e=0;$e<count($_POST['no']);$e++)
        {
            $id_deprueba = $_POST['no'][$e];
            $asd = mysqli_query($con, "DELETE from frases WHERE ID = '$id_deprueba'");
            
            if($e == 0){
            $ids .= $id_deprueba;    
            }
            else{
            $ids .= ", ".$id_deprueba;    
            }
            
            if($asd)
            {
            $_SESSION['message'] = "Frase/s id(s): ".$ids." eliminados";
            $_SESSION['tipo_mensaje'] = "eliminar";
	        header('location: ../admin_frases.php');
            }
    
        }    
    }
    
    if(isset($_POST['autorizar']) && count($_POST['no']>0))
    {
        for($e=0;$e<count($_POST['no']);$e++)
        {
            $id_deprueba1 = $_POST['no'][$e];
            $asd = mysqli_query($con, "UPDATE frases SET `autorizada`= '1' WHERE `ID`= '$id_deprueba1'");
            
            if($e == 0){
            $ids .= $id_deprueba1;    
            }
            else{
            $ids .= ", ".$id_deprueba1;    
            }
            
            if($asd)
            {
            $_SESSION['message'] = "Frase/s id(s): ".$ids." autorizados!"; 
            $_SESSION['tipo_mensaje'] = "autorizar";
	        header('location: ../admin_frases.php');
            }
    
        }    
    }
?>