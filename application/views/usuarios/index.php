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
                            <li class="nav-item"><button type="button" class="btn btn-primary btn-block" onclick="users.agregar()"><i class="fa fa-plus"></i> Agregar</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
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
    $.get("http://178.128.14.243:3000/cms_usuarios",(data, status,xhr)=>{
        console.log(xhr.status);
        let trs="";
        data.forEach((row)=>{
            trs+="<tr>";
            trs+="<td>"+row.name+"</td>";
            trs+="<td>"+row.usr+"</td>";
            trs+="<td>"+row.email+"</td>";
            trs+="<td><div class='btn-group'>";
                trs+="<button  title='Detalles' type='button' class='btn btn-primary btn-xs' onclick='users.details(\""+row.id+"\")'><i class='fas fa-edit'></i></button>";
                trs+="<button  title='Editar contraseña' type='button' class='btn btn-info btn-xs' onclick='users.updPwd(\""+row.id+"\",\""+row.nombre+"\")'><i class='fas fa-key'></i></button>";
                if(row.status==1){
                    trs+="<button  title='Habilitar' type='button' class='btn btn-danger btn-xs' onclick='users.disable(\""+row.id+"\")'><i class='fas fa-times' aria-hidden='true'></i></button>"
                }else{
                    trs+="<button title='Deshabilitar' type='button' class='btn btn-danger btn-xs' onclick='users.enable(\""+row.id+"\")'><i class='fas fa-check' aria-hidden='true'></i></button>"
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
const users ={
    details:(uuid)=>{
        $.get('<?=base_url('usuarios/ajax_getDetallesUsuario')?>',{uuid},(reply,status,xhr)=>{
            reply=jQuery.parseJSON(reply);
            if(reply.status=='1'){
                $('#modalDetalles').html(reply.vista);
                $('#modalDetalles').modal('show');
                bsCustomFileInput.init();
            }else alert(reply.msg);
        });
    },
    updPwd:(uuid,nombre)=>{
        $.get('<?=base_url('usuarios/ajax_getEditarPwd')?>',{uuid,nombre},(reply,status,xhr)=>{
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
        $.get('<?=base_url('usuarios/ajax_agregarUsuario')?>',(reply,status,xhr)=>{
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