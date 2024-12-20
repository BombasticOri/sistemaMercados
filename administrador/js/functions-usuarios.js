$('#tableusuarios').DataTable();
var tableusuarios;

document.addEventListener('DOMContentLoaded',function(){
    tableusuarios = $('#tableusuarios').DataTable({
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
        },
        "ajax": {
            "url": "./models/usuarios/table_usuarios.php",
            "dataSrc":""
        },
        "columns": [
            {"data":"acciones"},
            {"data":"usuario_id"},
            {"data":"nombre"},
            {"data":"apellido"},
            {"data":"email"},
            {"data":"identificador"},
            {"data":"rol_id"},
            {"data":"estado"}
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0,"asc"]]
    });

    var formUsuario = document.querySelector('#formUsuario');
    formUsuario.onsubmit = function(e) {
        e.preventDefault();

        var nombre = document.querySelector('#nombre').value;
        var apellido = document.querySelector('#apellido').value;
        var email = document.querySelector('#email').value;
        var identificador = document.querySelector('#identificador').value;
        var password = document.querySelector('#password').value;
        var rol_id = document.querySelector('#listRol').value;
        var estado = document.querySelector('#listEstado').value;

        if(nombre == '' || apellido == '' || email == '' || identificador == '' || password == ''){
            swal("Atención", "Todos los campos son necesarios", "error");
            return false;
        }

        var request  = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
        var url = './models/usuarios/ajax-usuarios.php';
        var form = new FormData(formUsuario);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalUsuario').modal('hide');
                    formUsuario.reset();
                    swal("Usuario",data.msg, "success");
                    tableusuarios.ajax.reload();
                }else{
                    swal("Usuario",data.msg, "error");
                }
            }
        }

    }
})

function openModal() {
    $('#modalUsuario').modal('show');
}