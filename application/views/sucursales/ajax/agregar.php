<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Agregar sucursal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="sid_sucursal">SID sucursal</label>
                <input type="text" class="form-control texto" id="sid_sucursal" placeholder="SID sucursal"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control texto" id="nombre" placeholder="Nombre"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="telefono_1">Teléfono</label>
                <input type="text" class="form-control texto" id="telefono_1" placeholder="Teléfono"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="telefono_2">Teléfono 2</label>
                <input type="text" class="form-control texto" id="telefono_2" placeholder="Teléfono 2"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="mail">Correo</label>
                <input type="text" class="form-control texto" id="mail" placeholder="Correo"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="coordenadas">Coordenadas</label>
                <input type="text" class="form-control texto" id="coordenadas" placeholder="Coordenadas"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="url_maps">Url maps</label>
                <input type="text" class="form-control texto" id="url_maps" placeholder="Url maps" 
                    autocomplete="off">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" placeholder="Dirección" autocomplete="off">
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
            if(validateEmail($('#mail').val())==true){
                 $('#mail').removeClass("is-valid").addClass("is-invalid");
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
            let allOk = validarCampos();
            if (allOk == true) {
                let patch = {
                    sid_sucursal:$('#sid_sucursal').val(),
                    nombre: $('#nombre').val(),
                    telefono_1: $('#telefono_1').val(),
                    telefono_2: $('#telefono_2').val(),
                    mail: $('#mail').val(),
                    coordenadas: $('#coordenadas').val(),
                    url_maps: $('#url_maps').val(),
                    direccion: $('#direccion').val(),
                    status:"N"
                }
                $.ajax({
                    type: 'POST',
                    url: 'http://178.128.14.243:3000/sucursales',
                    data: JSON.stringify(patch),
                    processData: false,
                    contentType: 'application/json',
                    success: function (data, status, xhr) {
                        if (xhr.status == 201) {
                            alert("Se agrego correctamente la sucursal.");
                        } else {
                            alert("Ocurrio un problema al agregar la sucursal, intentelo mas tarde.")
                        }
                        $('#modalDetalles').modal('hide');
                        getDataTable();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert("Ocurrio un problema al agregar la sucursal, intentelo mas tarde.")
                        // alert(xhr.status);
                        // alert(thrownError);
                    }
                });
            } else {
                alert("Es necesario ingresar información en todos los campos.");
            }

        });
    </script>