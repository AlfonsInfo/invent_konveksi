<?= $this->extend('/template/template.php'); ?>


<?= $this->section('content'); ?>
<body class="hold-transition login-page">
    <div class="login-box">
     <div class="login-logo">
        <b>Login Inventory Management System</b>
        <!-- <a href="../../index2.html"><b>Login</b></a> -->
    </div> 
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <i></i>
        <p class="login-box-msg"><i class="fas fa-user fa-2xl mr-2"></i>Only For Admin / Cashier    </p>

        <form action="../../index3.html" method="post">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user"></span>
                </div>
            </div>
            </div>
            <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                    Remember Me
                </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
            </div>
        </form>
        </div>
        <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->
<?= $this->endSection() ?>
