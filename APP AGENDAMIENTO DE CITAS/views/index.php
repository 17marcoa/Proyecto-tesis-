<?php
session_start();
if (!isset($_SESSION['user'])) :
    header("Location: /");
    exit();
endif;
require_once './header.php';
if($_SESSION['type_user'] == 'paciente'):
?>


<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="section-title position-relative pb-3 mb-5">
                    <h5 class="fw-bold text-primary text-uppercase">Clinica Emely </h5>
                    <h1 class="mb-0">Elija el medico con el que desea ser atendido</h1>
                </div>
                <div class="table-responsive-lg">
                    <table class="table">
                        <caption>List of users</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="table_medic">
                            
                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    </div>
</div>



<?php
elseif ($_SESSION['type_user'] == 'medico') : 
?>
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">

        <div class="col-lg-7">
            <div class="section-title position-relative pb-3 mb-5">
                <h5 class="fw-bold text-primary text-uppercase">Clínica Emely </h5>
                <h1 class="mb-0">Estas son sus citas</h1>
            </div>

            <div class="container d-flex justify-content-center flex-wrap align-items-center" id="consult_cita_medic" style="width: 80vw;" >



            </div>




        </div>
    </div>
</div><?php
endif;
require_once './footer.html';
