<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Cambiar contraseña a <?=$nombre?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="pwd">Nueva conraseña</label>
                <input type="password" class="form-control texto" id="pwd" placeholder="Nueva contraseña" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="pwd2">Repita nueva conraseña</label>
                <input type="password" class="form-control texto" id="pwd2" placeholder="Repita nueva contraseña" autocomplete="off">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="modal_actualizar">Actualizar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
$('#modal_actualizar').click(() => {
    let uuid = "<?=$uuid?>";
    
    if ($('#pwd').val()!="" && $('#pwd').val()==$('#pwd2').val()) {
        let patch = {
            password:$.md5($('#pwd').val())
        }
        $.ajax({
            type: 'PATCH',
            url: 'http://178.128.14.243:3000/clientes?uuid_cliente=eq.' + uuid,
            data: JSON.stringify(patch),
            processData: false,
            contentType: 'application/json',
            success: function (data, status, xhr) {
                if (xhr.status == 204) {
                    alert("Se actualizo correctamente la contaseña del cliente.");
                } else {
                    alert(
                        "Ocurrio un problema al actualizar la contraseña, intentelo mas tarde.")
                }
                $('#modalDetalles').modal('hide');
                getProductos();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("Ocurrio un problema al actualizar la contraseña, intentelo mas tarde.")
                // alert(xhr.status);
                // alert(thrownError);
            }
        });
    } else {
        alert("Es necesario que las contraseñas sean iguales.");
    }

});
</script>