<?/*==================================================================================================================================*/?>
<?$this->load->view('content/header')?>
<?/*==================================================================================================================================*/?>
<style>
    .dropdown-menu{
        background:#6c757d;
    }
    a.buttons-columnVisibility.active:hover{
        background: #adb3b8 !important;
    }
    .buttons-columnVisibility.active{
        background:#6c757d !important;
    }
    a.buttons-columnVisibility:hover{
       background:#6c757d;
    }
    a.buttons-columnVisibility{
        background:#adb3b8;
    }
    td:last-child{
        text-align:center !important;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?/*==================================================================================================================================*/?>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">Productos</h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><button type="button" class="btn btn-primary btn-block" onclick="productos.agregar()"><i class="fa fa-plus"></i> Agregar</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id producto</th>
                                    <th>No. parte</th>
                                    <th>Marca</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                            <tfoot>
                                <tr>
                                    <th>Id producto</th>
                                    <th>No. parte</th>
                                    <th>Marca</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer"></div>
                </div>
                <!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
        <?/*==================================================================================================================================*/?>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?/*==================================================================================================================================*/?>
<?$this->load->view('content/footer')?>
<?/*==================================================================================================================================*/?>
<div id="modalDetalles" class="modal fade" data-backdrop="static" data-keyboard="false"></div>
<script>
$(function() {
    getProductos();
});
let getProductos=()=>{
    $('#table').DataTable().clear();
    $('#table').DataTable().destroy();
    $.get("http://178.128.14.243:3000/productos",(data, status,xhr)=>{
        console.log(xhr.status);
        let trs="";
        data.forEach((row)=>{
            trs+="<tr>";
            trs+="<td>"+row.producto_id+"</td>";
            trs+="<td>"+row.no_parte+"</td>";
            trs+="<td>"+row.marca+"</td>";
            trs+="<td>"+row.nombre+"</td>";
            trs+="<td><div class='btn-group'>";
                trs+="<button  title='Detalles' type='button' class='btn btn-primary btn-xs' onclick='productos.details(\""+row.uuid_producto+"\")'><i class='fas fa-plus'></i></button>";
                if(row.status==1){
                    trs+="<button  title='Habilitar' type='button' class='btn btn-danger btn-xs' onclick='productos.disable(\""+row.uuid_producto+"\")'><i class='fas fa-times' aria-hidden='true'></i></button>";
                }else{
                    trs+="<button title='Deshabilitar' type='button' class='btn btn-danger btn-xs' onclick='productos.enable(\""+row.uuid_producto+"\")'><i class='fas fa-check' aria-hidden='true'></i></button>";
                }
            trs+="</div></td>";
            trs+="</tr>";
        });
        $('#tableBody').html(trs);
        $("#table").DataTable({
            "dom":"Bfrtip",
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            "buttons": [
                "copy",
                "csv", 
                "excel", 
                "pdf", 
                "print", 
                "colvis"
            ]
        }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
    });
};
const productos ={
    details:(uuid)=>{
        $.get('<?=base_url('productos/ajax_getDetallesProducto')?>',{uuid},(reply,status,xhr)=>{
            reply=jQuery.parseJSON(reply);
            if(reply.status=='1'){
                $('#modalDetalles').html(reply.vista);
                $('#modalDetalles').modal('show');
                bsCustomFileInput.init();
            }else alert(reply.msg);
        });
    },
    diable:(uuid)=>{

    },
    enable:(uuid)=>{
        
    },
    agregar:()=>{
        $.get('<?=base_url('productos/ajax_agregarProducto')?>',(reply,status,xhr)=>{
            reply=jQuery.parseJSON(reply);
            if(reply.status=='1'){
                $('#modalDetalles').html(reply.vista);
                $('#modalDetalles').modal('show');
                bsCustomFileInput.init();
            }else alert(reply.msg);
        });
    },
};

</script>