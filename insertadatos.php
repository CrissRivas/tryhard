<?php

if(isset($_POST['opc'])){

    $opc    = $_POST['opc'];
    $correo = isset($_POST['correo'])?$_POST['correo']:"";

    $data = '{"Opcion":"'.$opc.'","Correo":"'.$correo.'"}';
    $url  = "https://nuevo1-fa197-default-rtdb.firebaseio.com/nvacamp.json";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
    
    $response = curl_exec($ch);
    
    if ( curl_errno($ch) ) {
        echo 'Error:'.curl_errno($ch);
    }else {
        echo "Ya inserto!";
    }
}


?>