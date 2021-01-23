<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Agregar usuario cms</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control texto" id="name" placeholder="Nombre" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="usr">Usuario</label>
                <input type="text" class="form-control texto" id="usr" placeholder="Usuario" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="text" class="form-control texto" id="email" placeholder="Correo" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="pwd">Contraseña</label>
                <input type="password" class="form-control" id="pwd" placeholder="Nueva contraseña" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="pwd2">Repita contraseña</label>
                <input type="password" class="form-control" id="pwd2" placeholder="Repita nueva contraseña"
                    autocomplete="off">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="modal_actualizar">Agregar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    <script>
        validarCampos = () => {
            let allOk = true;
            $('.texto').each((i, e) => {
                if ($(e).val() == "") {
                    allOk = false;
                    $(e).removeClass("is-valid").addClass("is-invalid");
                } else {
                    $(e).removeClass("is-invalid").addClass("is-valid");
                }
            });
            if (validateEmail($('#email').val()) == true) {
                $('#email').removeClass("is-invalid").addClass("is-valid");
            } else {
                $('#email').removeClass("is-valid").addClass("is-invalid");
                allOk = false;
            }
            if ($('#pwd').val() != "" && $('#pwd').val() == $('#pwd2').val()) {
                $('#pwd').removeClass("is-invalid").addClass("is-valid");
                $('#pwd2').removeClass("is-invalid").addClass("is-valid");
            } else {
                $('#pwd').removeClass("is-valid").addClass("is-invalid");
                $('#pwd2').removeClass("is-valid").addClass("is-invalid");
                allOk = false;
            }
            return allOk;
        }
        validateEmail = (email) => {
            const re =
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        $('#modal_actualizar').click(() => {
            let allOk = validarCampos();
            if (allOk == true) {
                let patch = {
                    name: $('#name').val(),
                    usr: $('#usr').val(),
                    email: $('#email').val(),
                    pwd: $('#pwd').val(),
                    idUserType: 1,
                }
                $.post('<?=base_url('usuarios/ajax_setUsuario')?>', patch, (reply, status, xhr) => {
                    reply = jQuery.parseJSON(reply);
                    alert(reply.msg);
                    if (reply.status == '1') {
                        $('#modalDetalles').modal('hide');
                        getDataTable();
                    }
                });
            } else {
                alert("Es necesario ingresar información en todos los campos.");
            }

        });
    </script>