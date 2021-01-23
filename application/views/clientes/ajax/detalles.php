<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Editar producto <?=$cliente->nombre?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control texto" id="nombre" placeholder="Nombre"
                    value="<?=$cliente->nombre?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="nombre_2">Nombre corto</label>
                <input type="text" class="form-control texto" id="nombre_2" placeholder="Nombre corto"
                    value="<?=$cliente->nombre_2?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control texto" id="telefono" placeholder="Teléfono"
                    value="<?=$cliente->telefono?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" class="form-control texto" id="celular" placeholder="Celular"
                    value="<?=$cliente->celular?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="mail">Correo</label>
                <input type="text" class="form-control texto" id="mail" placeholder="Correo"
                    value="<?=$cliente->mail?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="persona_contacto">Contacto</label>
                <input type="text" class="form-control texto" id="mail" placeholder="Contacto"
                    value="<?=$cliente->persona_contacto?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="rfc">RFC</label>
                <input type="text" class="form-control texto" id="rfc" placeholder="RFC" value="<?=$cliente->rfc?>"
                    autocomplete="off">
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
            if(validateEmail($('#mail').val())==true){
                 $('#mail').removeClass("is-invalid").addClass("is-valid");
            }else{
                 $('#mail').removeClass("is-valid").addClass("is-invalid");
                 allOk = false;
            }
            return allOk;
        }
        validateEmail=(email) => {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        $('#modal_actualizar').click(() => {
            let uuid = "<?=$cliente->uuid_cliente?>";
            let allOk = validarCampos();
            if (allOk == true) {
                let patch = {
                    nombre: $('#nombre').val(),
                    nombre_2: $('#nombre_2').val(),
                    telefono: $('#telefono').val(),
                    celular: $('#celular').val(),
                    mail: $('#mail').val(),
                    persona_contacto: $('#persona_contacto').val(),
                    rfc: $('#rfc').val(),
                }
                $.ajax({
                    type: 'PATCH',
                    url: 'http://178.128.14.243:3000/clientes?uuid_cliente=eq.' + uuid,
                    data: JSON.stringify(patch),
                    processData: false,
                    contentType: 'application/json',
                    success: function (data, status, xhr) {
                        if (xhr.status == 204) {
                            alert("Se actualizo correctamente la información del cliente.");
                        } else {
                            alert(
                                "Ocurrio un problema al actualizar la informacion del cliente, intentelo mas tarde.")
                        }
                        $('#modalDetalles').modal('hide');
                        getDataTable();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert("Ocurrio un problema al actualizar la informacion del cliente, intentelo mas tarde.")
                        // alert(xhr.status);
                        // alert(thrownError);
                    }
                });
            } else {
                alert("Es necesario ingresar información en todos los campos.");
            }

        });
    </script>