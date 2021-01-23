<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Agregar notificacion</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control texto" id="titulo" placeholder="Titulo"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="text" class="form-control texto" id="fecha" placeholder="Fecha"
                     autocomplete="off">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" class="form-control texto" id="descripcion" placeholder="Descripción"
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
            return allOk;
        }
        $('#modal_actualizar').click(() => {
            let allOk = validarCampos();
            if (allOk == true) {
                let patch = {
                    titulo:$('#titulo').val(),
                    fecha: $('#fecha').val(),
                    descripcion: $('#descripcion').val(),
                    uuid_cliente: "8e96af95-4575-47e9-a2aa-b56aba2f035f"
                }
                $.ajax({
                    type: 'POST',
                    url: 'http://178.128.14.243:3000/notificaciones',
                    data: JSON.stringify(patch),
                    processData: false,
                    contentType: 'application/json',
                    success: function (data, status, xhr) {
                        if (xhr.status == 201) {
                            alert("Se agrego correctamente la notificación.");
                        } else {
                            alert("Ocurrio un problema al agregar la notificación, intentelo mas tarde.")
                        }
                        $('#modalDetalles').modal('hide');
                        getDataTable();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert("Ocurrio un problema al agregar la notificación, intentelo mas tarde.")
                        // alert(xhr.status);
                        // alert(thrownError);
                    }
                });
            } else {
                alert("Es necesario ingresar información en todos los campos.");
            }

        });
    </script>