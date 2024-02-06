<?php
session_start();
if (!isset($_SESSION['user'])) :
    header("Location: /");
    exit();
endif;
$medic = isset($_GET['medic']) ? $_GET['medic'] : '';
require_once './header.php';
if ($_SESSION['type_user'] != 'medico') :
?>

    <input type="hidden" name="" id="medic" value="<?php echo $medic; ?>">

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container ">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative">
                        <h5 class="fw-bold text-primary text-uppercase">Clínica Emely </h5>
                    </div>
                    <div class="table-responsive-lg">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="table_single_medic">

                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">

            <div class="col-lg-7">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">Clinica Emely </h5>
                    <h1 class="mb-0">Elija el horario de su preferencia</h1>
                </div>

                <div class="container d-flex justify-content-center flex-wrap align-items-center" id="agendar_cita">

                </div>




            </div>
        </div>
    </div>



<?php
elseif ($_SESSION['type_user'] == 'medico'):
?>
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">

            <div class="col-lg-7">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">Clínica Emely </h5>
                    <h1 class="mb-0">Crear Medico</h1>
                </div>

                <div style="width: 80vw;" class="d-flex justify-content-center flex-wrap align-items-center">
                    <form id="insert_cita_medic">
                        <label for="fecha_inicio">Fecha de Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" required>

                        <label for="fecha_fin">Fecha de Fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" required>

                        <label for="intervalo_tiempo">Intervalo de Tiempo entre Citas (minutos):</label>
                        <input type="number" name="intervalo_tiempo" id="intervalo_tiempo" min="1" required>

                        <button type="submit">Programar Citas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
require_once './footer.html';
