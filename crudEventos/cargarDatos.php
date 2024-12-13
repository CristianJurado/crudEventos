<?php
    $host = "localhost";
    $dbname = "eventos_deportivos";
    $username = "root";
    $password = "";
    
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    $ruta_csv = 'C:\xampp\htdocs\crudEventos\crudEventos\prueba.csv';
    $handle = fopen($ruta_csv,'r');
    $test = fgetcsv($handle,1000,',');
    print_r($test);
    while(($fila = fgetcsv($handle,1000,',')) !== false){
        print_r($fila);
        print_r($fila[0]);
        $sql="INSERT INTO eventos (nombre_evento, tipo_deporte, fecha, hora, ubicacion, id_organizador) 
        VALUES ('$fila[0]', '$fila[1]', '$fila[2]', '$fila[3]', '$fila[4]', '$fila[5]') ";
        print_r($sql);
        if(mysqli_query($conn, $sql)){
            echo"Registro Correcto";
        }else
        echo "Error al registrar";
    }
    fclose($handle);

?>