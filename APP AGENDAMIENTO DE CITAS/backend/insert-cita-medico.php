<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once './connect.php';
    $fechaInicio = $_POST["fecha_inicio"];
    $fechaFin = $_POST["fecha_fin"];
    $intervaloTiempo = $_POST["intervalo_tiempo"];

    // Convertir fechas a objetos DateTime
    $fechaInicioObj = DateTime::createFromFormat('Y-m-d', $fechaInicio);
    $fechaFinObj = DateTime::createFromFormat('Y-m-d', $fechaFin);

    // Configurar el intervalo de tiempo entre citas
    $intervalo = new DateInterval("PT{$intervaloTiempo}M");

    // Configurar el horario de atención
    $horaInicio = new DateTime("08:00:00");
    $horaFin = new DateTime("17:00:00");

    // ID del médico 
    $idUsuarioMedico = $_SESSION['user'];

    // Crear citas y realizar inserciones en la base de datos
    $fechaCita = clone $fechaInicioObj;

    while ($fechaCita <= $fechaFinObj) {
        //if ($fechaCita->format('N') >= 1 && $fechaCita->format('N') <= 5) {
            $horaCita = $horaInicio;

            while ($horaCita <= $horaFin) {
                $idMedico = $_SESSION['user'];
                $fechaHoraCita = $fechaCita->format('Y-m-d') . ' ' . $horaCita->format('H:i:s');
                $sql = "INSERT INTO cita (id_medico, fecha_hora_cita) VALUES ((select m.id_medico from medico m where m.id_usuario = '".$idMedico."'), '$fechaHoraCita')";
                $result = $mysql->query($sql);
                // Incrementar la hora de la cita
                $horaCita->add($intervalo);
            }
            
            $fechaCita->add(new DateInterval("P1D"));
            echo $fechaCita->format('Y-m-d').$horaCita->format('H:M:S').'-'.$fechaFinObj->format('Y-m-d').'*/*';
        //}

        // Incrementar la fecha de la cita al siguiente día
        
    }

    echo "Citas programadas exitosamente.";
} else {
    echo "Acceso no permitido.";
}

