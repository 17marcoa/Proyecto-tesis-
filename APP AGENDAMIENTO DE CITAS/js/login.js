//Ejecutando funciones
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPage);

//Declarando variables
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

//FUNCIONES

function anchoPage() {

    if (window.innerWidth > 850) {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
    }
}

anchoPage();

function iniciarSesion() {
    if (window.innerWidth > 850) {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "10px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}

function register() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
}

$(document).ready(() => {

    const $formulario__register = $('#formulario__register');







    $('#formulario__register').submit((e) => {
        e.preventDefault()
        const postData = {
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            identification: $('#identification').val(),
            type_identification: $('#type_identification').val(),
            phone: $('#phone').val()
        }
        console.log(postData)
        let url = "../backend/insert-user.php";
        $.post(url, postData, function (response) {
            let res = JSON.parse(response);
            console.log(res)
            if (res[0]['successful']) {
                Swal.fire({
                    title: 'Error!',
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

    $('#formulario__login').submit((e) => {
        e.preventDefault()
        const postData = {
            user: $('#username').val(),
            password: $('#password_user').val(),
        }
        console.log(postData)
        let url = "../backend/consult-user.php";
        $.get(url, postData, function (response) {
            console.log(response)
            let res = JSON.parse(response);
            console.log(res)
            if (res[0]['successful']) {
                Swal.fire({
                    title: 'Bienvenido!',
                    text: res[0]['successful'],
                    icon: 'success',
                    confirmButtonText: '<a style="text-decoration: none; color:  white; font-size: 20px" href="/Views/">Ok</a>'
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
});