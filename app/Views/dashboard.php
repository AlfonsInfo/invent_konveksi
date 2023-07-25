<?= $this->extend('/template/template'); ?>

<?= $this->section('content'); ?>

<body class="hold-transition sidebar-mini">
<!-- WRAPPER -->
<div class="wrapper">
  <?= $this->include('template/headerNav'); ?>
  <?= $this->include('template/sideBar'); ?>

  <?= $this->include('template/header'); ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

    <?= $this->include('template/footer') ?>
</div>
<!-- ./wrapper -->
<?= $this->endSection(); ?>
