<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') :

    require_once './connect.php';

    $sql = "select  m.id_medico,
                    m.nombre, 
                    COALESCE(m.img_medico, 'default.jpeg') img_medico,
                    e.nombre_especialidad 
            from medico m
            inner join especialidad e on  m.especialidad_id = e.id_especialidad;";
    $res = $mysql->query($sql);
    $json = [];
    if (!$mysql->affected_rows > 0) :
        $json[] = array(
            'error' => 'No existe el usuario'
        );
        $jsonString = json_encode($res);
        echo $jsonString;
        return;
    else :

        while ($row = $res->fetch_assoc()) :
            $json[] = $row;
            
        endwhile;
        $jsonString = json_encode($json);
        echo $jsonString;

        $mysql->close();
    endif;
endif;
