<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once './connect.php';
    //  name, email, password, identicacion, telefono, tipo_identifacion,  
    $name = isset($_POST["name"]) ? trim($_POST["name"])  : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"])  : '';
    $password = isset($_POST["password"]) ? trim($_POST["password"])  : '';
    $ced = isset($_POST["identification"]) ? trim($_POST["identification"]) : '';
    $type_identification = isset($_POST["type_identification"]) ? trim($_POST['type_identification']) : '';
    $cell = isset($_POST["phone"]) ? trim($_POST["phone"])  : '';
    $perfil = 'paciente';


    $json = [];
    if (($type_identification == 'cedula' && !strlen($cell) == 10) || ($type_identification == 'ruc' && !strlen($cell) == 13)  || !strlen($cell) == 10) :
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
                'error' => 'El correo ya existe'
            );
            $jsonString = json_encode($json);
            echo $jsonString;
            return;
        else :
            $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

            $InsertSql = "INSERT INTO usuario 
                                            (
                                            name,
                                            email,
                                            password,
                                            tipo_usuario,
                                            identicacion,
                                            telefono,
                                            tipo_identifacion)
                                    VALUES(
                                        '" . $name . "',
                                        '" . $email. "',
                                        '" . $password_segura. "',
                                        '" . $perfil . "',
                                        '" . $ced . "',
                                        '" . $cell . "',
                                        '" . $type_identification . "'
                                        );";

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
