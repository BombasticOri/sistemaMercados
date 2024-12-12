$(document).ready(function () {
    $('#loginAdmin').on('click', function () {
        loginAdmin();
    });
    $('#loginUsuario').on('click', function () {
        loginUsuario();
    });
});

function loginAdmin() {
    var identificador = $('#adminIdentificador').val();
    var password = $('#adminPassword').val();

    $.ajax({
        url: './includes/loginAdmin.php',
        method: 'POST',
        data: {
            identificador: identificador,
            password: password
        },
        success: function (data) {
            $('#messageAdmin').html(data);

            if (data.indexOf('Redirigiendo') > -1) {
                window.location = 'administrador/';
            }
        }
    });
}

function loginUsuario() {
    var identificador = $('#userIdentificador').val();
    var password = $('#userPassword').val();

    $.ajax({
        url: './includes/loginUsuario.php',
        method: 'POST',
        data: {
            identificador: identificador,
            password: password
        },
        success: function (data) {
            $('#messageUsuario').html(data);

            if (data.indexOf('Redirigiendo') > -1) {
                window.location = 'usuario/';
            }
        }
    });
}