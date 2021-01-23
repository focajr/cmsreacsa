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
                            <li class="nav-item"><button type="button" class="btn btn-primary btn-block" onclick="sucursal.agregar()"><i class="fa fa-plus"></i> Agregar</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SID sucursal</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Telefono 2</th>
                                    <th>Mail</th>
                                    <th>Dirección</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                            <tfoot>
                                <tr>
                                    <th>SID sucursal</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Telefono 2</th>
                                    <th>Mail</th>
                                    <th>Dirección</th>
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
    $.get("http://178.128.14.243:3000/sucursales",(data, status,xhr)=>{
        console.log(xhr.status);
        let trs="";
        data.forEach((row)=>{
            trs+="<tr>";
            trs+="<td>"+row.sid_sucursal+"</td>";
            trs+="<td>"+row.nombre+"</td>";
            trs+="<td>"+row.telefono_1+"</td>";
            trs+="<td>"+row.telefono_2+"</td>";
            trs+="<td>"+row.mail+"</td>";
            trs+="<td>"+row.direccion+"</td>";
            trs+="<td>"+row.status+"</td>";
            trs+="<td><div class='btn-group'>";
                trs+="<button  title='Detalles' type='button' class='btn btn-primary btn-xs' onclick='sucursal.details(\""+row.id_sucursal+"\")'><i class='fas fa-edit'></i></button>";
                if(row.status==1){
                    trs+="<button  title='Habilitar' type='button' class='btn btn-danger btn-xs' onclick='clients.disable(\""+row.id_sucursal+"\")'><i class='fas fa-times' aria-hidden='true'></i></button>"
                }else{
                    trs+="<button title='Deshabilitar' type='button' class='btn btn-danger btn-xs' onclick='clients.enable(\""+row.id_sucursal+"\")'><i class='fas fa-check' aria-hidden='true'></i></button>"
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
const sucursal ={
    details:(uuid)=>{
        $.get('<?=base_url('sucursales/ajax_getDetallesSucursal')?>',{uuid},(reply,status,xhr)=>{
            reply=jQuery.parseJSON(reply);
            if(reply.status=='1'){
                $('#modalDetalles').html(reply.vista);
                $('#modalDetalles').modal('show');
                bsCustomFileInput.init();
            }else alert(reply.msg);
        });
    },
    diable:(id)=>{

    },
    enable:(id)=>{
        
    },
    agregar:()=>{
        $.get('<?=base_url('sucursales/ajax_agregarSucursal')?>',(reply,status,xhr)=>{
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