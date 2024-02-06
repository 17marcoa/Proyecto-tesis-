<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    date_default_timezone_set('America/Guayaquil');

    $fechaActual = date("Y-m-d");
    require_once './connect.php';
    $medico = $_GET['medico'];
    
    // Obtener el primer día de la semana actual
    $primerDiaSemana = date("Y-m-d", strtotime('monday this week'));
    
    $sql = "SELECT  c.id_cita,
                    m.nombre,
                    DATE_FORMAT(c.fecha_hora_cita, '%Y-%m-%d') AS fecha,
                    DATE_FORMAT(c.fecha_hora_cita, '%H:%i') AS hora,
                    e.nombre_especialidad
                FROM
                    cita c
                INNER JOIN
                    medico m ON c.id_medico = m.id_medico
                INNER JOIN
                    especialidad e ON m.especialidad_id = e.id_especialidad
                WHERE
                    c.id_medico = '" . $medico . "'
                    AND c.estado = 1
                    AND DATE(c.fecha_hora_cita) BETWEEN '" . $primerDiaSemana . "' AND '" . $fechaActual . "';";
    
    $res = $mysql->query($sql);
    $json = [];

    while ($row = $res->fetch_assoc()) {
        $json[] = $row;
    }

    $jsonString = json_encode($json);
    echo $jsonString;

    $mysql->close();
}
?>
