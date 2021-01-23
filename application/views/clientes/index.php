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
                        <h3 class="card-title p-3">Sucursales</h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><button type="button" class="btn btn-primary btn-block" onclick="clients.agregar()"><i class="fa fa-plus"></i> Agregar</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Celular</th>
                                    <th>Mail</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Celular</th>
                                    <th>Mail</th>
                                    <th>Status</th>
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
    getDataTable();
});
let getDataTable=()=>{
    $('#table').DataTable().clear();
    $('#table').DataTable().destroy();
    $.get("http://178.128.14.243:3000/clientes",(data, status,xhr)=>{
        console.log(xhr.status);
        let trs="";
        data.forEach((row)=>{
            trs+="<tr>";
            trs+="<td>"+row.nombre+"</td>";
            trs+="<td>"+row.telefono+"</td>";
            trs+="<td>"+row.celular+"</td>";
            trs+="<td>"+row.mail+"</td>";
            trs+="<td>"+row.status+"</td>";
            trs+="<td><div class='btn-group'>";
                trs+="<button  title='Detalles' type='button' class='btn btn-primary btn-xs' onclick='clients.details(\""+row.uuid_cliente+"\")'><i class='fas fa-edit'></i></button>";
                trs+="<button  title='Editar contraseña' type='button' class='btn btn-info btn-xs' onclick='clients.updPwd(\""+row.uuid_cliente+"\",\""+row.nombre+"\")'><i class='fas fa-key'></i></button>";
                if(row.status==1){
                    trs+="<button  title='Deshabilitar' type='button' class='btn btn-danger btn-xs' onclick='clients.disable(\""+row.uuid_cliente+"\")'><i class='fas fa-times' aria-hidden='true'></i></button>"
                }else{
                    trs+="<button title='Habilitar' type='button' class='btn btn-danger btn-xs' onclick='clients.enable(\""+row.uuid_cliente+"\")'><i class='fas fa-check' aria-hidden='true'></i></button>"
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
}
const clients ={
    details:(uuid)=>{
        $.get('<?=base_url('clientes/ajax_getDetallesCliente')?>',{uuid},(reply,status,xhr)=>{
            reply=jQuery.parseJSON(reply);
            if(reply.status=='1'){
                $('#modalDetalles').html(reply.vista);
                $('#modalDetalles').modal('show');
                bsCustomFileInput.init();
            }else alert(reply.msg);
        });
    },
    updPwd:(uuid,nombre)=>{
        $.get('<?=base_url('clientes/ajax_getEditarPwd')?>',{uuid,nombre},(reply,status,xhr)=>{
            reply=jQuery.parseJSON(reply);
            if(reply.status=='1'){
                $('#modalDetalles').html(reply.vista);
                $('#modalDetalles').modal('show');
                bsCustomFileInput.init();
            }else alert(reply.msg);
        });
    },
    disable:(uuid)=>{
        let patch = {
            status:0
        }
        $.ajax({
            type: 'PATCH',
            url: 'http://178.128.14.243:3000/clientes?uuid_cliente=eq.' + uuid,
            data: JSON.stringify(patch),
            processData: false,
            contentType: 'application/json',
            success: function (data, status, xhr) {
                if (xhr.status == 204) {
                    alert("Se deshabilito correctamente el usuario.");
                } else {
                    alert("Ocurrio un problema al deshabilito el usuario, intentelo mas tarde.")
                }
                $('#modalDetalles').modal('hide');
                getDataTable();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("Ocurrio un problema al deshabilito el usuario, intentelo mas tarde.")
                // alert(xhr.status);
                // alert(thrownError);
            }
        });
    },
    enable:(uuid)=>{
        let patch = {
            status:1
        }
        $.ajax({
            type: 'PATCH',
            url: 'http://178.128.14.243:3000/clientes?uuid_cliente=eq.' + uuid,
            data: JSON.stringify(patch),
            processData: false,
            contentType: 'application/json',
            success: function (data, status, xhr) {
                if (xhr.status == 204) {
                    alert("Se habilito correctamente el usuario.");
                } else {
                    alert("Ocurrio un problema al habilitar el usuario, intentelo mas tarde.")
                }
                $('#modalDetalles').modal('hide');
                getDataTable();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("Ocurrio un problema al habilitar el usuario, intentelo mas tarde.")
                // alert(xhr.status);
                // alert(thrownError);
            }
        });
    },
    agregar:()=>{
        $.get('<?=base_url('clientes/ajax_agregarCliente')?>',(reply,status,xhr)=>{
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