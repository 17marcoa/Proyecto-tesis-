<?php


session_start();
if (!isset($_SESSION['user'])) :
    header("Location: /");
    exit();
endif;
$cita = isset($_GET['cita']) ? $_GET['cita'] : '';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Facturación</title>
    <link rel="stylesheet" href="../css/facturacion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>

<body>
    <main class="container">
        <input type="hidden" name="" id="citaId" value="<?php echo $cita ?>">
        <form class="invoice-form">
            <!-- Información del Cliente -->
            <h2>Información del Cliente <a href="/views/">volver</a>
            </h2>

            <table>
                <tr>
                    <td>Cédula:</td>
                    <td>
                        <input type="search" id="search" list="ced" autocomplete="off" required>
                        <datalist id="ced">

                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td>Nombre:</td>
                    <td><input type="text" id="name" name="cliente_nombre" autocomplete="off" readonly></td>
                </tr>
                <tr>
                    <td>Correo electrónico:</td>
                    <td><input type="email" id="email" name="cliente_email" autocomplete="off" readonly></td>
                </tr>
                <tr>
                    <td>Teléfono:</td>
                    <td><input type="tel" id="cell" name="cliente_telefono" autocomplete="off" readonly></td>
                </tr>
            </table>

            <h2>Descripción Medica </h2>

            <table>
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <textarea name="" id="dataMedico"></textarea>
                        </td>

                        <td><button class="blue" id="send-SRI">Guardar <i class="fa-solid fa-paper-plane"></i></button></td>

                    </tr>
                </tbody>
            </table>

            <!-- Agregar un producto -->
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Existencia</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Precio Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="hidden" name="" id="idPro">
                            <input type="search" name="" id="searchPro" list="pro">
                            <datalist id="pro">

                            </datalist>
                        </td>
                        <td id="descripcion"> </td>
                        <td id="stock"> </td>
                        <td><input type="text" id="cantidad" disabled></td>
                        <td id="precio"> </td>
                        <td id="total"> 00.00 </td>
                        <td><button hidden id="agregar"> <i class="fa-solid fa-plus"></i> </button></td>

                    </tr>
                </tbody>
            </table>

            <h2>Medicamentos
            </h2>

            <table>
                <thead>
                    <tr>

                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Unitario</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="data-fac">

                </tbody>
            </table>

            <div class="total">
                <label>Subtotal:</label>
                <span id="subTotalFactura">$0.00</span>
            </div>

            <div class="total">
                <label>Total:</label>
                <span id="totalFactura">$0.00</span>
            </div>


        </form>

        <div id="modal_container" class="modal-container">
            <section class="modal">

                <section>
                    <h2>Agregar Cliente</h2>
                    <i class="fa-solid fa-rectangle-xmark" id="close"></i>

                </section>

                <form action="#" method="post" class="modal__form" id="form">
                    <div>
                        <input required type="text" placeholder="INGRESE EL RUC O CÉDULA" name="ruc" id="ruc">
                    </div>
                    <div>
                        <input required type="text" placeholder="INGRESE LOS APELLIDOS " name="surname" id="surname">
                    </div>
                    <div>
                        <input required type="text" placeholder="INGRESE LOS NOMBRES " name="name" id="name">
                    </div>
                    <div>
                        <input required type="email" placeholder="INGRESE EL CORREO " name="email" id="emailClient">
                    </div>
                    <div>
                        <input required type="text" placeholder="INGRESE EL CELULAR " name="cell" id="cellClient">
                    </div>

                    <div>
                        <br>
                        <button type="submit"> GUARDAR CLIENTE</button>
                    </div>
                </form>

            </section>

        </div>
    </main>
    <?php
    if ($_SESSION['type_user'] == 'paciente') :
    ?>
        <script src="../js/citaUser.js"></script>
    <?php
    else :
    ?>
        <script src="../js/cita.js"></script>
    <?php endif; ?>
</body>

</html>