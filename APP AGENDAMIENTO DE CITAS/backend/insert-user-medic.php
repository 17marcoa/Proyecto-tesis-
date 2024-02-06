<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once './connect.php';
    $name = isset($_POST["name"]) ? trim($_POST["name"])  : '';
    $especialidad = isset($_POST["especialidad"]) ? trim($_POST['especialidad']) : '';
    $ced = isset($_POST["identification"]) ? trim($_POST["identification"]) : '';
    $cell = isset($_POST["phone"]) ? trim($_POST["phone"])  : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"])  : '';
    $password = isset($_POST["password"]) ? trim($_POST["password"])  : '';
    

    $json = [];
    if ((!strlen($cell) == 13)  || !strlen($cell) == 10) :
        $json[] = array(
            'error' => 'Verificar los campos de cédula y tipo de identificación'
        );
        $jsonString = json_encode($json);
        echo $jsonString;
        return;
    else :
        $sql = "SELECT * FROM  usuario  WHERE email = '" . $email . "' AND identification = '" . $ced . "';";
        $result = $mysql->query($sql);

        if ($mysql->affected_rows >= 1) :
            $json[] = array(
                'error' => 'Revise el correo y la identificación'
            );
            $jsonString = json_encode($json);
            echo $jsonString;
            return;
        else :
            $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

            $InsertSql = "call insert_medic('" . $name . "','" . $email . "', '" . $password_segura . "', '" . $ced . "','" . $cell . "', $especialidad);";

            $resultCall = $mysql->query($InsertSql);
            if ($resultCall) {
                $json[] = array(
                    'successful' => 'Usuario registrado con éxito'
                );

                $mysql->close();
                $jsonString = json_encode($json);
                echo $jsonString;
                return;
            }

        endif;
    endif;
}
