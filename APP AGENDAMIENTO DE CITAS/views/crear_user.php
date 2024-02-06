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
                <h1 class="mb-0">Crear Medico</h1>
            </div>

            <div style="width: 80vw;" class="d-flex justify-content-center flex-wrap align-items-center">
                <form id="create_medic">
                    <div class="form-row d-flex">
                        <div class="form-group col-md-8">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <br>
                        <div class="form-group col-md-8" style="margin-left : 5px">
                            <label for="especialidad">Especialidad</label>

                            <select name="" class="form-control" id="especialidad">
                                <optgroup id="consult_especialidad">

                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-row d-flex">
                        <div class="form-group col-md-8">
                            <label for="identification">Ruc</label>
                            <input type="text" class="form-control" id="identification">
                        </div>
                        <br>
                        <div class="form-group col-md-8" style="margin-left : 5px">
                            <label for="phone">Teléfono</label>
                            <input type="text" class="form-control" id="phone">
                        </div>
                    </div>
                    <div class="form-row d-flex">
                        <div class="form-group col-md-8">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <br>
                        <div class="form-group col-md-8" style="margin-left : 5px">
                            <label for="password_user">Password</label>
                            <input type="password" class="form-control" id="password_user">
                        </div>
                    </div>
                    <br>


                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </form>


            </div>
        </div>
    </div>
</div>
<?php
require_once './footer.html';
