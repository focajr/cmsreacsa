<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Editar usuario cms <?=$usuario->name?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control texto" id="name" placeholder="Nombre"
                    value="<?=$usuario->name?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="usr">Usuario</label>
                <input type="text" class="form-control texto" id="usr" placeholder="Correo"
                    value="<?=$usuario->usr?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="text" class="form-control texto" id="email" placeholder="Correo"
                    value="<?=$usuario->email?>" autocomplete="off">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="modal_actualizar">Actualizar</button>
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
            if(validateEmail($('#email').val())==true){
                $('#mail').removeClass("is-invalid").addClass("is-valid");
            }else{
                $('#email').removeClass("is-valid").addClass("is-invalid");
                allOk = false;
            }
            return allOk;
        }
        validateEmail=(email) => {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        $('#modal_actualizar').click(() => {
            let uuid = "<?=$usuario->id?>";
            let allOk = validarCampos();
            if (allOk == true) {
                let patch = {
                    name: $('#name').val(),
                    usr: $('#usr').val(),
                    email: $('#email').val()
                }
                $.ajax({
                    type: 'PATCH',
                    url: 'http://178.128.14.243:3000/cms_usuarios?id=eq.' + uuid,
                    data: JSON.stringify(patch),
                    processData: false,
                    contentType: 'application/json',
                    success: function (data, status, xhr) {
                        if (xhr.status == 204) {
                            alert("Se actualizo correctamente la información del usuario.");
                        } else {
                            alert(
                                "Ocurrio un problema al actualizar la informacion del usuario, intentelo mas tarde.")
                        }
                        $('#modalDetalles').modal('hide');
                        getDataTable();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert("Ocurrio un problema al actualizar la informacion del usuario, intentelo mas tarde.")
                        // alert(xhr.status);
                        // alert(thrownError);
                    }
                });
            } else {
                alert("Es necesario ingresar información en todos los campos.");
            }

        });
    </script>