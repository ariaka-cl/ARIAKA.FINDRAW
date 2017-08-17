(function ($) {
    var base_url = window.location.origin;

    $('#send-urs').click(function () {
        var usuario = {
            ID: $('#id-user').val(),
            Nombre: $('#name').val(),
            Run: $('#run').val(),
            Nick: $('#nick').val(),
            Rol: $('#role').val(),
            Pass: $('#password').val()
        };
        if (validaUser(usuario)) {

            $.ajax({
                method: 'POST',
                url: base_url + '/usuarios/add',
                dataType: 'json',
                data: {usuario},
                success: (function (msg) {
                    alert("Felicitaciones, se guardo con éxito.");
                     window.location.replace(base_url + '/usuarios');

                }),
                error: (function (err) {
                    alert('Mensaje: ' + err.statusText);
                    $('#nick').val('');
                    $('#run').val('');
                    $('#name').val('');
                    $('#password').val('');
                    $('#password2').val('');
                    $('#role').val('');
                })
            });
        }
        ;
    });

    $.getJSON(base_url + '/usuarios/roles').done(function (result) {
        var role = $('#role');
        $.each(result.Role, function (i) {
            role.append('<option value="' + result.Role[i].Id + '">' + result.Role[i].Nombre + '</option>');
        });
    });

    function validaUser(usuario) {
        if (usuario.Nombre === '') {
            return false;
        } else if (usuario.Run === '') {
            return false;
        } else if (usuario.Nick === '') {
            return false;
        } else if (usuario.Rol === '') {
            return false;
        } else if (usuario.Pass === '') {
            return false;
        }
        return true;
    }

    $("button").click(function () {
        if (this.id === 'send-urs')
            return;
        var idUser = $(this).attr('id');

        if (idUser.includes('del-')) {
            var idUsuarioDel = $(this).attr('value');
            $( "#userIdDel" ).attr( "value", idUsuarioDel );
            $('#userIdDel').html('<p> ¿Realmente Desea Eliminar al Usuario Seleccionado? </p>');
            $('#del-user').modal('show');                                

        } else {

            $.getJSON(base_url + '/usuarios/getuser/' + idUser).done(function (result) {

                $.each(result.Usuario, function (i) {
                    $('#name').val(result.Usuario[i].Nombre);
                    $('#run').val(result.Usuario[i].Rut);
                    $('#nick').val(result.Usuario[i].Nick);
                    $('#role select').val(result.Usuario[i].Role);
                    $('#role option:selected').text(result.Usuario[i].Role);
                    $('#id-user').val(result.Usuario[i].ID);
                });

            });
        }

    });
    $("#btn-eliminar-urs").click(function () {
        var usuarioIdDel = $("#userIdDel").attr('value');
        
        $.ajax({
                method: 'POST',
                url: base_url + '/usuarios/delete',
                dataType: 'json',
                data: {id:usuarioIdDel},
                success: (function (msg) {                    
                     $('#userIdDel').html('<p> Se elimina Registro con Éxito </p>');
                    if(msg.Usuarios==='OK'){ 
                     setTimeout("$('#del-user').modal('hide')", 2000);
                     window.location.replace(base_url + '/usuarios');
                    }
                })                
            });
        
    });

})(jQuery);

