<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Editar producto <?=$producto->nombre?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="producto_id">Id Producto</label>
                <input type="text" class="form-control texto" id="producto_id" placeholder="Id producto" value="<?=$producto->producto_id?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="no_parte">No. parte</label>
                <input type="text" class="form-control texto" id="no_parte" placeholder="No. parte" value="<?=$producto->no_parte?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" class="form-control texto" id="marca" placeholder="Marca" value="<?=$producto->marca?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control texto" id="nombre" placeholder="Nombre" value="<?=$producto->nombre?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="desc_corta">Descripción corta</label>
                <input type="text" class="form-control texto" id="desc_corta" placeholder="Descripción corta" value="<?=$producto->desc_corta?>" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="desc_larga">Descripción larga</label>
                <textarea id="desc_larga" class="form-control texto" rows="3"
                    placeholder="Descripción larga"><?=$producto->desc_larga?></textarea>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-primary">
                      <input type="checkbox" class="custom-control-input" id="status" <?=(($producto->status==1)?'checked':'')?> >
                      <label class="custom-control-label" for="status">Estatus</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-primary">
                      <input type="checkbox" class="custom-control-input" id="visible" <?=(($producto->visible===true)?'checked':'')?> >
                      <label class="custom-control-label" for="visible">Visible</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-primary">
                      <input type="checkbox" class="custom-control-input" id="nuevo" <?=(($producto->nuevo===true)?'checked':'')?> >
                      <label class="custom-control-label" for="nuevo">Nuevo</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-primary">
                      <input type="checkbox" class="custom-control-input" id="promocion" <?=(($producto->promocion===true)?'checked':'')?> >
                      <label class="custom-control-label" for="promocion">Promocion</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-default custom-switch-on-primary">
                      <input type="checkbox" class="custom-control-input" id="destacado" <?=(($producto->destacado===true)?'checked':'')?> >
                      <label class="custom-control-label" for="destacado">Destacado</label>
                    </div>
                  </div>
                </div>
            </div>
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
validarCampos=()=>{
    let allOk=true;
    $('.texto').each((i,e)=>{
        if($(e).val()==""){
            allOk=false;
            $(e).removeClass("is-valid").addClass("is-invalid");
        }else{
            $(e).removeClass("is-invalid").addClass("is-valid");
        }
    });
    return allOk;
}

$('#modal_actualizar').click(()=>{
    let uuid="<?=$producto->uuid_producto?>";
    let allOk=validarCampos();
    if(allOk==true){
        let patch={
            producto_id:$('#producto_id').val(),
            no_parte:$('#no_parte').val(),
            marca:$('#marca').val(),
            nombre:$('#nombre').val(),
            desc_corta:$('#desc_corta').val(),
            desc_larga:$('#desc_larga').val(),
            status:($('#status:checked').length==1)?1:0,
            visible:($('#visible:checked').length==1)?true:false,
            nuevo:($('#nuevo:checked').length==1)?true:false,
            promocion:($('#promocion:checked').length==1)?true:false,
            destacado:($('#destacado:checked').length==1)?true:false,
        }
        $.ajax({
            type: 'PATCH',
            url: 'http://178.128.14.243:3000/productos?uuid_producto=eq.'+uuid,
            data: JSON.stringify(patch),
            processData: false,
            contentType: 'application/json',
            success: function(data, status, xhr) {
                if(xhr.status==204){
                    alert("Se actualizo correctamente la información del producto.");
                }else{
                    alert("Ocurrio un problema al actualizar el producto, intentelo mas tarde.")
                }
                $('#modalDetalles').modal('hide');
                getProductos();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("Ocurrio un problema al actualizar el producto, intentelo mas tarde.")
                // alert(xhr.status);
                // alert(thrownError);
            }
        });
    }else{
        alert("Es necesario ingresar información en todos los campos");
    }
    
});
</script>