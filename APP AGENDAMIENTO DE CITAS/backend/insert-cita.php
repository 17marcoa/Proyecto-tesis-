<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once './connect.php';
    
    var_dump($_POST);
    /*
    {
    "id_paciente": "4",
    "temperatura": "565",
    "presion": "565",
    "peso": "56565",
    "pulso": "56565",
    "edad": "65656",
    "genero": "5656",
    "estado_civil": "soltero",
    "diagnostico": "565656565\n                                ",
    "medicamento": "5656565\n                                "
}
    */


    // $json = [];


    // $InsertSql = "call insert_medic('" . $name . "','" . $email . "', '" . $password_segura . "', '" . $ced . "','" . $cell . "', $especialidad);";

    // $resultCall = $mysql->query($InsertSql);
    // if ($resultCall) {
    //     $json[] = array(
    //         'successful' => 'Usuario registrado con éxito'
    //     );

    //     $mysql->close();
    //     $jsonString = json_encode($json);
    //     echo $jsonString;
    //     return;
    // }
}
