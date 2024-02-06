<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    require_once './connect.php';
    require_once './function_mail.php';
    $user = $_SESSION['user'];
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $hora = isset($_POST['hora']) ? $_POST['hora'] : '';
    $json = [];
    $sql = '';
    if ($id) :
        if($_SESSION['type_user'] == 'medico'):
            $sql = "UPDATE cita set estado = 5 where id_cita = '" . $id . "';";
        else:    
            $sql = "UPDATE cita set id_paciente = '" . $user . "', estado = 2 where id_cita = '" . $id . "';";
            send_correo($_SESSION['email'], $date, $hora);
        endif;
        $result = $mysql->query($sql);

        if ($mysql->affected_rows >= 1) :
            $json[] = array(
                'resultado' => 'Cita agendada con éxito'
            );
            $response = json_encode($json);
            echo $response;
            $mysql->close();
            return;
        endif;
        $json[] = array(
            'error' => 'No se pudo agendar la cita'
        );
        $response = json_encode($json);
        echo $response;
        $mysql->close();
        return;
    endif;
endif;
$json[] = array(
    'error' => 'Debe seleccionar una cita, para agendar'
);
$response = json_encode($json);
echo $response;
return;
