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
                <h3 class="card-title">Product </h3>
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
                <form action="/products/create" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" aria-describedby="emailHelp" placeholder="Nama Produk" name="nama_produk">
                    </div>
                    <div class="form-group">
                        <label for="harga_produk">Harga Produk</label>
                        <input type="text" class="form-control" id="nama_produk" aria-describedby="emailHelp" placeholder="Harga Produk" name="harga_produk">
                    </div>
                    <!--//* Warna  -->
                    <div class="form-group">
                        <label for="warna">Warna</label>
                        <select class="form-control" id="warna" name="id_details_warna">
                            <?php foreach($warna as $w) : ?>
                                <option value="<?= $w['id_details']?>"><?= $w['nilai']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <!--//* Ukuran  -->
                    <div class="form-group">
                        <label for="ukuran">ukuran</label>
                        <select class="form-control" id="ukuran" name="id_details_ukuran">
                            <?php foreach($ukuran as $w) : ?>
                                <option value="<?= $w['id_details']?>"><?= $w['nilai']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <!--//* Brand -->
                    <div class="form-group" >
                        <label for="brand">brand</label>
                        <select class="form-control" id="ukuran" name="id_brand">
                            <?php foreach($brands as $w) : ?>
                                <option value="<?= $w['id_brand']?>"><?= $w['nama_brand']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <!--//* Kategori  -->
                        <div class="form-group" >
                        <label for="kategori">kategori</label>
                        <select class="form-control" id="kategori" name="id_category">
                            <?php foreach($kategori as $w) : ?>
                                <option value="<?= $w['id_category']?>"><?= $w['nama_category']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="stok_total">Stok Awal</label>
                        <input type="number" class="form-control" id="stok_total" aria-describedby="emailHelp" placeholder="100" name="stok_total">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto/Gambar Produk</label>
                        <input class="form-control" type="file" id="formFile" name="foto_product">
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
