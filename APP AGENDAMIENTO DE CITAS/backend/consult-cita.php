<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') :
    date_default_timezone_set('America/Guayaquil');
    require_once './connect.php';
    $id = $_GET['id'];
    $json = [];
    $sql = "SELECT  u.id_usuario,
                    u.name,
                    u.email,
                    u.identicacion,
                    DATE_FORMAT(c.fecha_hora_cita, '%Y-%m-%d') AS fecha,
                    DATE_FORMAT(c.fecha_hora_cita, '%H:%i') AS hora,
                    e.nombre_especialidad,
                    c.estado,
                    C.observacion
                FROM
                    cita c
                INNER JOIN
                    medico m ON c.id_medico = m.id_medico
                INNER JOIN
                    especialidad e ON m.especialidad_id = e.id_especialidad
                INNER JOIN
                    usuario u ON c.id_paciente = u.id_usuario
                WHERE
                    c.id_cita = '".$id."'";
    $res = $mysql->query($sql);

    while ($row = $res->fetch_assoc()) :
        $json[] = $row;

    endwhile;
    $jsonString = json_encode($json);
    echo $jsonString;

    $mysql->close();

endif;
