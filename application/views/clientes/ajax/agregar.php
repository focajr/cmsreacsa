<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Agregar cliente</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control texto" id="nombre" placeholder="Nombre"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="nombre_2">Nombre corto</label>
                <input type="text" class="form-control texto" id="nombre_2" placeholder="Nombre corto"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control texto" id="telefono" placeholder="Teléfono"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" class="form-control texto" id="celular" placeholder="Celular"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="mail">Correo</label>
                <input type="text" class="form-control texto" id="mail" placeholder="Correo"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="persona_contacto">Contacto</label>
                <input type="text" class="form-control texto" id="mail" placeholder="Contacto"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="rfc">RFC</label>
                <input type="text" class="form-control texto" id="rfc" placeholder="RFC" 
                    autocomplete="off">
            </div>
            <div class="form-group">
                <label for="pwd">Contraseña</label>
                <input type="password" class="form-control" id="pwd" placeholder="Nueva contraseña" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="pwd2">Repita contraseña</label>
                <input type="password" class="form-control" id="pwd2" placeholder="Repita nueva contraseña" autocomplete="off">
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
                 $('#mail').removeClass("is-valid").addClass("is-invalid");
            }else{
                 $('#mail').removeClass("is-valid").addClass("is-invalid");
                 allOk = false;
            }
            if($('#pwd').val()!="" && $('#pwd').val()==$('#pwd2').val()){
                $('#pwd').removeClass("is-invalid").addClass("is-valid");
                $('#pwd2').removeClass("is-invalid").addClass("is-valid");
            }else{
                $('#pwd').removeClass("is-valid").addClass("is-invalid");
                $('#pwd2').removeClass("is-valid").addClass("is-invalid");
                 allOk = false;
            }
            return allOk;
        }
        validateEmail=(email) => {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
        $('#modal_actualizar').click(() => {
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
                    password:$.md5($('#pwd').val()),
                    sucursal:1,
                    tipo_empresa:1,
                    status:0
                }
                $.ajax({
                    type: 'POST',
                    url: 'http://178.128.14.243:3000/clientes',
                    data: JSON.stringify(patch),
                    processData: false,
                    contentType: 'application/json',
                    success: function (data, status, xhr) {
                        if (xhr.status == 201) {
                            alert("Se agrego correctamente el cliente.");
                        } else {
                            alert("Ocurrio un problema al agregar el cliente, intentelo mas tarde.")
                        }
                        $('#modalDetalles').modal('hide');
                        getDataTable();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert("Ocurrio un problema al agregar cliente, intentelo mas tarde.")
                        // alert(xhr.status);
                        // alert(thrownError);
                    }
                });
            } else {
                alert("Es necesario ingresar información en todos los campos.");
            }

        });
    </script>