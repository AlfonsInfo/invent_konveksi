<?php
?>

<?= $this->extend('/template/template.php') ?>
<?= $this->section('content') ?>

<body>
    <?= $this->include('template/sidebar') ?>
    <?= $this->include('template/headerNav'); ?>
    <?= $this->include('template/header'); ?>

     <!-- Main content -->
     <div class="content">
      <div class="container-fluid">
      <div class="card">

          <div class="card-header">
                <h3 class="card-title">User </h3>
                <!-- Tampilkan pesan error jika ada -->
                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger">
                        <p>Gagal Menambahkan Data</p>
                        <ul>
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
              </div>
            <!-- /.card-header -->
            <div class="m-4">
                <form action="/users/save" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_user">Nama User</label>
                        <input type="text" class="form-control" id="nama_user" aria-describedby="emailHelp" placeholder="Nama User" name="nama_user">
                    </div>
                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" class="form-control" id="nama_produk" aria-describedby="emailHelp" placeholder="username" name="username">
                    </div>
                    <!--//* role  -->
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="id_role">
                            <?php foreach($roles as $r) : ?>
                                <option value="<?= $r['id_role']?>"><?= $r['nama_role']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto Pengguna</label>
                        <input class="form-control" type="file" id="formFile" name="foto_user">
                    </div>

                    <button type="submit" class="btn btn-success">Tambah</button>
                </form>
            </div>
        </div>
            <!-- /.card -->

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<script>
</script>


<?= $this->endSection() ?>
