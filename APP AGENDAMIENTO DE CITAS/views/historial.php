<?php
session_start();
if (!isset($_SESSION['user'])) :
    header("Location: /");
    exit();
endif;
require_once './header.php';
?>




<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">

        <div class="col-lg-7">
            <div class="section-title position-relative pb-3 mb-5">
                <h5 class="fw-bold text-primary text-uppercase">Clínica Emely </h5>
                <h1 class="mb-0">Estas son sus citas</h1>
            </div>

            <div class="container d-flex justify-content-center flex-wrap align-items-center" id="consult_cita_user" style="width: 80vw;" >



            </div>




        </div>
    </div>
</div>



<?php
require_once './footer.html';
