$(document).ready(() => {

    (() => {
        $.get('../backend/consult-medico.php', (res) => {
            let result = JSON.parse(res);
            let template = '';
            let i = 0;
            result.forEach(element => {
                i += 1;
                template += `
                            <tr>                            
                                <th scope="row">${i}</th>
                                <td><img src="../Img_Medicos/${element.img_medico}" alt="" height="50px" width="50px"></td>
                                <td>${element.nombre}</td>
                                <td>${element.nombre_especialidad}</td>
                                <td class="btn__agendar" >
                                    <a href="./cita.php?medic=${element.id_medico}">
                                        <button type="button" class="btn btn-primary">
                                            Agendar Cita
                                        </button> 
                                    </a> 
                                </td>
                            </tr>
                `
            });

            $('#table_medic').html(template);
        });
    })();

    (() => {
        ver_citas();
        consult_especialidad();
        consult_citas_medic();
    })();

    (() => {
        let medico = $('#medic').val()
        const queryString = `?medico=${medico}`
        $.get(`../backend/single-medico.php${queryString}`, (res) => {
            let result = JSON.parse(res);
            let template = '';
            if (result.length > 0) {

                result.forEach(element => {

                    template += `
                            <tr>                            
                                
                                <td><img src="../Img_Medicos/${element.img_medico}" alt="" height="50px" width="50px"></td>
                                <td>${element.nombre}</td>
                                <td>${element.nombre_especialidad}</td>
                                
                            </tr>
                `
                });
            } else {
                template = '<p>No hay datos</p>';
            }
            $('#table_single_medic').html(template);
        });
    })();


    $(document).on("click", ".save_cita", function (e) {
        const element = $(this).closest("div");
        const id = $(element).attr("cita-id");
        const date = $(element).attr("cita-date");
        const hora = $(element).attr("cita-hora");

        $.post('../backend/save-cita.php', { id: id, date, hora}, (res) => {
            let result = JSON.parse(res);
            
            Swal.fire({
                title: '',
                text: result[0]['resultado'],
                icon: 'success',
                confirmButtonText: '<a style="text-decoration: none; color:  white; font-size: 20px" href="./index.php">Ok</a>'
            })
            ver_citas();
        });
    });

    $(document).on("click", ".atender_cita", function (e) {
        const element = $(this).closest("div");
        const id = $(element).attr("atender-cita-id");
        $.post('../backend/save-cita.php', { id: id }, (res) => {
            let result = JSON.parse(res);
            console.log(res)
            window.location = `./atender.php?cita=${id}`
        });
    });

    function ver_citas() {
        let medico = $('#medic').val()
        const queryString = `?medico=${medico}&date=2023-01-12`;
        $.get(`../backend/consult-cita-date.php${queryString}`, (res) => {

            let result = JSON.parse(res);
            let template = '';
            if (result.length > 0) {
                let i = 0;
                result.forEach(element => {
                    template += `
                        <div class="card border-primary mb-3" style="max-width: 18rem;margin :5px"   >
                            
                            <div class="card-body text-primary" cita-id="${element.id_cita}" cita-date="${element.fecha}" cita-hora="${element.hora}">
                            <h5 class="card-title">Cita Disponible</h5>
                            <p class="card-text"> Especialidad : ${element.nombre_especialidad}</p>
                            <p class="card-text"> Dia: ${element.fecha}</p>
                            <p class="card-text"> Hora: ${element.hora}</p>
                            
                            <button type="button" class="btn btn-primary save_cita" >
                                Agendar Cita
                            </button> 
                                    
                            </div>
                        </div>
                        <br>
                `
                });
            } else {
                template = `<p>
                    No hay citas disponibles en esta fecha
                </p>`
            }

            $('#agendar_cita').html(template)
        });
    }

    (() => {
        $.get(`../backend/consult-cita-user.php`, (res) => {
            let result = JSON.parse(res);
            let template = '';
            let state = '';
            if (result.length > 0) {

                result.forEach(element => {
                    if (element.estado == 2) {
                        state = "pendiente";
                    } else if (element.estado == 3) {
                        state = "culminada";
                    }
                    else if (element.estado == 3) {
                        state = "cancelada";
                    }
                    template += `
                    <div class="card border-primary mb-3" style="max-width: 18rem;margin :5px"   >
                        <div class="card-body text-primary" cita-id="${element.id_cita}">
                            <h5 class="card-title">Cita Disponible</h5>
                            <p class="card-text"> Especialidad : ${element.nombre_especialidad}</p>
                            <p class="card-text"> Doctor : ${element.nombre}</p>
                            <p class="card-text"> Dia: ${element.fecha}</p>
                            <p class="card-text"> Hora: ${element.hora}</p>
                            <p class="card-text"> Estado: ${state}</p>
                        </div>
                    </div>
                <br>
                `
                });
            } else {
                template = '<p>No hay datos</p>';
            }
            $('#consult_cita_user').html(template);
        });
    })();


    function consult_especialidad() {
        $.get(`../backend/consult-especialidad.php`, (res) => {
            let result = JSON.parse(res);
            let template = '';
            let state = '';
            if (result.length > 0) {

                result.forEach(element => {
                    template += `
                    <option value="${element.id_especialidad}">
                        ${element.nombre_especialidad}
                    </option>`
                });
            }
            $('#consult_especialidad').html(template);
        });
    }

    $('#create_medic').submit((e) => {
        e.preventDefault()
        const postData = {
            name: $('#name').val(),
            especialidad: $('#especialidad').val(),
            identification: $('#identification').val(),
            phone: $('#phone').val(),
            email: $('#email').val(),
            password: $('#password_user').val(),
        }

        let url = "../backend/insert-user-medic.php";
        $.post(url, postData, function (response) {
            let res = JSON.parse(response);
            if (res[0]['successful']) {
                Swal.fire({
                    title: 'success!',
                    text: res[0]['successful'],
                    icon: 'success',
                    confirmButtonText: 'Cool'
                })
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: res[0]['error'],
                    icon: 'error',
                    confirmButtonText: 'Ok',
                })
            }
        });
    });

    $('#create_medicina').submit((e) => {
        e.preventDefault()
        const postData = {
            name: $('#name').val(),
            indicaciones: $('#indicaciones').val(),
            precio: $('#precio').val(),
            stock: $('#stock').val(),
        }

        let url = "../backend/insert-medicina.php";
        $.post(url, postData, function (response) {
            console.log(response)
            let res = JSON.parse(response);
            if (res[0]['successful']) {
                Swal.fire({
                    title: 'success!',
                    text: res[0]['successful'],
                    icon: 'success',
                    confirmButtonText: 'Cool'
                })
                this.trim()
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: res[0]['error'],
                    icon: 'error',
                    confirmButtonText: 'Ok',
                })
            }
        });
    });

    function consult_citas_medic() {
        $.get(`../backend/consult-cita-medic.php`, (res) => {
            let result = JSON.parse(res);
            let template = '';
            let state = '';
            let btn = ''
            if (result.length > 0) {


                result.forEach(element => {
                    if (element.estado == 2) {
                        state = "pendiente";
                        btn = ` <button type="button" class="btn btn-primary atender_cita" >
                        Atender
                    </button> `
                    } else if (element.estado == 3) {
                        state = "culminada";
                        btn = '';
                    }
                    else if (element.estado == 3) {
                        state = "cancelada";
                        btn = '';
                    }
                    else if (element.estado == 5) {
                        state = "atendiendo";
                        btn = `<a href="atender.php?cita${element.id_cita}"> Ver cita </a>`;

                    }
                    template += `
                <div class="card border-primary mb-3" style="max-width: 18rem;margin :5px"   >
                    <div class="card-body text-primary" atender-cita-id="${element.id_cita}">
                        <h5 class="card-title">Cita Disponible</h5>
                        <p class="card-text"> Paciente : ${element.paciente}</p>
                        <p class="card-text"> Doctor : ${element.nombre}</p>
                        <p class="card-text"> Dia: ${element.fecha}</p>
                        <p class="card-text"> Hora: ${element.hora}</p>
                        <p class="card-text"> Estado: ${state}</p>
                        ${btn}
                    </div>
                </div>
            <br>
            `
                });
            } else {
                template = '<p>No hay datos</p>';
            }
            $('#consult_cita_medic').html(template);
        });
    }


   
    (() => {
        let citaId = $('#citaId').val()
        const queryString = `?id=${citaId}`
        $.get(`../backend/consult-medicamento.php`, (res) => {
            
            let result = JSON.parse(res);
            let template = '';
            
            if (result.length > 0) {

                result.forEach(element => {
                    template += `
                    <option value="${element.id_medicamento}">
                        ${element.nombre}
                    </option>`
                });
            } else {
                template = '<p>No hay datos</p>';
            }
            $('#medicamentos').html(template);
        });
    })();

    $('#save_cita_medic').submit((e) => {
        e.preventDefault()
        const postData = {
            id_paciente: $('#id_paciente').val(),
            temperatura: $('#temperatura').val(),
            presion: $('#presion').val(),
            peso: $('#peso').val(),
            pulso: $('#pulso').val(),
            edad: $('#edad').val(),
            genero: $('#genero').val(),
            estado_civil: $('#estado_civil').val(),
            diagnostico: $('#diagnostico').val(),
            medicamento: $('#medicamento').val(),
        }
        console.log(postData)
        // let url = "../backend/insert-user-medic.php";
        // $.post(url, postData, function (response) {
        //     let res = JSON.parse(response);
        //     if (res[0]['successful']) {
        //         Swal.fire({
        //             title: 'success!',
        //             text: res[0]['successful'],
        //             icon: 'success',
        //             confirmButtonText: 'Cool'
        //         })
        //     } else {
        //         Swal.fire({
        //             title: 'Error!',
        //             text: res[0]['error'],
        //             icon: 'error',
        //             confirmButtonText: 'Ok',
        //         })
        //     }
        // });
    });

    $('#insert_cita_medic').submit((e) => {
        e.preventDefault()
        const postData = {
            fecha_inicio: $('#fecha_inicio').val(),
            fecha_fin: $('#fecha_fin').val(),
            intervalo_tiempo: $('#intervalo_tiempo').val(),
        }
        console.log(postData)
        let url = "../backend/insert-cita-medico.php";
        $.post(url, postData, function (response) {
            Swal.fire({
                title: 'success!',
                text: response,
                icon: 'success',
                confirmButtonText: 'Cool'
            })

        });
    });


    
});