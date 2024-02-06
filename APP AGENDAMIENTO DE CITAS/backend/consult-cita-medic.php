<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') :
    date_default_timezone_set('America/Guayaquil');
    require_once './connect.php';
    $user = $_SESSION['user'];
    $sql = "SELECT  c.id_cita,
                    m.nombre,
                    u.name paciente,
                    DATE_FORMAT(c.fecha_hora_cita, '%Y-%m-%d') AS fecha,
                    DATE_FORMAT(c.fecha_hora_cita, '%H:%i') AS hora,
                    e.nombre_especialidad,
                    c.estado
                FROM
                cita c
                INNER JOIN
                medico m ON c.id_medico = m.id_medico
                INNER JOIN
                especialidad e ON m.especialidad_id = e.id_especialidad
                INNER JOIN
                usuario u ON c.id_paciente = u.id_usuario
                WHERE
                m.id_usuario =  '".$user."'";
    $res = $mysql->query($sql);
    $json = [];

    while ($row = $res->fetch_assoc()) :
        $json[] = $row;

    endwhile;
    $jsonString = json_encode($json);
    echo $jsonString;

    $mysql->close();

endif;
