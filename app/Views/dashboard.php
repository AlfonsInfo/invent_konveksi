<?php  //dd(session()->get('id_user'));?>

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
          <!-- Small boxes (Stat box) -->
          <div class="row">
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div> -->
          <!-- </div> -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= session()->get('count')?></h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <!-- <i class="fas fa-arrow-circle-right"></i> -->
              <p href="#" class="small-box-footer">Number of users</p>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>

                <p>Products</p>
              </div>
              <div class="icon">
                <i class="fas fa-tshirt"></i>
              </div>
              <a href="products" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- <div class="col-lg-3 col-6">
            small box
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <p>Incoming Goods</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div> -->
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <!-- <div class="small-box bg-info">
              <div class="inner">
                <h3>65</h3>
                <p>Outgoing Goods</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div> -->
          </div>
          <!-- ./col -->
        </div>
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
