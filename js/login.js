$(document).ready(function(){
    $('#loginAdmin').on('click',function(){
        loginAdmin();
    });
    $('#loginUsuario').on('click',function(){
        loginUsuario();
    });
});

function loginAdmin(){
    var login = $('#usuario').val();
    var pass = $('#pass').val();

    $.ajax({
        url: './includes/loginAdmin.php',
        method: 'POST',
        data:{
            login:login,
            pass:pass
        },
        succes: function(data){
            $('messageAdmin').html(data);

            if(data.indexOf('Redirecting') >-0){
                window.location - 'administrador/';
            }
        }
    })
}

function loginUsuario(){
    var login = $('#usuario').val();
    var pass = $('#pass').val();

    $.ajax({
        url: './includes/loginUsuario.php',
        method: 'POST',
        data:{
            login:login,
            pass:pass
        },
        succes: function(data){
            $('messageUsuario').html(data);

            if(data.indexOf('Redirecting') >-0){
                window.location - 'usuario/';
            }
        }
    })
}

