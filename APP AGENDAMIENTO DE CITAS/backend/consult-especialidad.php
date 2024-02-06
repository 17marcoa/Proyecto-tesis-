<?php 

if($_SERVER['REQUEST_METHOD'] == 'GET'):
    require_once './connect.php';
    $sql = "SELECT  e.id_especialidad, e.nombre_especialidad from especialidad e where e.estado = 1";
    $result = $mysql->query($sql);
    $response = [];
    while($row = $result->fetch_assoc()):
        $response[] = $row;
    endwhile;
    $jsonString = json_encode($response);
    echo $jsonString;
    $mysql->close();
endif;  
