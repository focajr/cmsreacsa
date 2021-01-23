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
    
    if ($('#pwd').val()!="" && $('#pwd').val()==$('#pwd2').val()) {
        let patch = {
            uuid:"<?=$uuid?>",
            pwd:$('#pwd').val()
        }
        $.post('<?=base_url('usuarios/ajax_setPwd')?>', patch, (reply, status, xhr) => {
            reply = jQuery.parseJSON(reply);
            alert(reply.msg);
            if (reply.status == '1') {
                $('#modalDetalles').modal('hide');
                getDataTable();
            }
        });
    } else {
        alert("Es necesario que las contraseñas sean iguales.");
    }

});
</script>