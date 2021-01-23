<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/dist/css/adminlte.min.css')?>">
    <link rel="shortcut icon" href="<?=base_url('assets/img/logo.jpg');?>">
</head>

<body class="hold-transition login-page" style="background: #FFF">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?=base_url()?>">
                <img src="<?=base_url('assets/img/logo.jpg')?>" height="100" style="    margin-top: -20px;" />
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">

            <!-- <form action="" method="post"> -->
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Usuario" name="usr" id="usr">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Contraseña" name="pwd" id="pwd">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" id="ingresar">Ingresar</button>
                    </div>
                    <!-- /.col -->
                </div>
            <!-- </form> -->


        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('assets/dist/js/adminlte.min.js')?>"></script>
    <!-- LoadingOverlay -->
    <script src="<?=base_url('assets/plugins/loader/loadingoverlay.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/loader/loadingoverlay_progress.min.js')?>"></script>
</body>

</html>
<script>
    $(document).ajaxStart(function(){
        $.LoadingOverlay("show");
    });
    $(document).ajaxStop(function(){
        $.LoadingOverlay("hide");
    });
    $("#ingresar").click(function () {
        doLogin();
    });
    $('#pwd').keypress(function (e) {
        // Enter pressed?
        if (e.which == 10 || e.which == 13) {
            doLogin();
        }
    });

    function doLogin() {
        if ($("#usr").val() != "" && $("#pwd").val() != "") {
            $.ajax({
                cache: false,
                // async: false,
                method: "POST",
                url: "<?=base_url('login/webLogin')?>",
                data: "usr=" + $("#usr").val() + "&pwd=" + $("#pwd").val(),
                success: function (data) {
                    var json_result = $.parseJSON(data);
                    if (json_result.data) {
                        window.location.href = "<?=base_url('dashboard')?>";
                    } else {
                        
                        alert(json_result.msg);
                    }

                },
                error: function () {
                    alert("No fue posible conectarse al servidor, intentelo mas tarde");
                }
            });
        } else {
            alert("Es necesario ingresar un usuario y contraseña.");
        }
    }
</script>