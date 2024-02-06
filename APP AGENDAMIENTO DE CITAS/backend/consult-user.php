<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') :
    require_once './connect.php';

    $user  =  isset($_GET['user']) ? $_GET['user'] : '';
    $password  =  isset($_GET['password']) ? $_GET['password'] : '';
    $json = [];

    if ($user && $password) :
        $sql = "SELECT id_usuario, tipo_usuario, email, password  from usuario where email =  '". $user ."'";
        $result = $mysql->query($sql);
        $json = [];
        if (!$mysql->affected_rows > 0) :
            $json[] = array(
                'error' => 'No existe el usuario'
            );
            $jsonString = json_encode($json);
            echo $jsonString;
            return;
        else :
            
            while ($row = $result->fetch_assoc()) :
                $verify = password_verify($password, $row['password']);
                if ($verify) :
                    $json[] = array(
                        'successful' => 'Bienvenido',
                    );
                    $_SESSION['user'] = $row['id_usuario'];
                    $_SESSION['type_user'] = $row['tipo_usuario'];
                    $_SESSION['email'] = $row['email'];

                else :
                    $json[] = array(
                        'error' => 'Credenciales incorrectas',
                        
                    );
                endif;
            endwhile;
            $json_string = json_encode($json);
            echo $json_string;
        endif;
        $mysql->close();
    endif;
endif;
