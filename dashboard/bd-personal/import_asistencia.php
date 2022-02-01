<?php
include_once "conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();
//CHECAR SI LA CONEXION ES EXISTOSA
/*
if($conexion){
    echo "estas conectado";
}*/
$allowedFileType=['text/txt', 'text/csv', 'text/plain'];
if(in_array($_FILES["file"]["type"],$allowedFileType)){
    $targetPath = 'subidas/'.$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'],$targetPath);
    //echo "archivo movido";
    $archivo = $targetPath;
    //ABRIR EL ARCHIVO TXT
    //$archivo_open = fopen($archivo, 'r');
    //echo $linea;
    $linea = file($archivo);
    //SENTENCIA SQL 
    $t_sql = 'REPLACE INTO asistencia (id, idEmpleado, fecha, hora) VALUES (NULL, ?, ?, ?)';
    $resultado = $conexion->prepare($t_sql);
    $resultado-> bindParam(1, $idEmpleado);
    $resultado-> bindParam(2, $fecha);
    $resultado-> bindParam(3, $hora);

    foreach($linea as $num_linea => $line){
        $data = explode(',', $line);
        $idEmpleado = $data[2];
        $fecha = $data[7];
        $hora = $data[8];
        if($num_linea != 0){
            //print_r($data);
            $resultado->execute();
            
            //print_r($line);
            //$result = $conexion->prepare($t_sql);
            //$result -> execute();

            //echo "importacion con exito";
            //print_r($data);
            //$data = explode(',', $linea);
            //print_r($data);
        }
    }
    /*
    //SE RECORRE EL ARCHIVO
    while(feof($archivo_open)==false){

        $line = fgets($archivo_open);
        $data = explode('|', $line);
        
    };
    fclose($archivo_open);*/
    header('location: ../asistencia.php');
}

//$nombre = ($_FILES['file']['name']);

//echo ($nombre);