<?php
        $rupiahFormatter = new \App\Controllers\RupiahFormatter();
?>

<?= $this->extend('/template/template.php') ?>
<?= $this->section('content') ?>

<body>
    <?= $this->include('template/sidebar') ?>
    <?= $this->include('template/headerNav'); ?>
    <?= $this->include('template/header'); ?>
    <style>
        .empty-cart-message {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px; /* Sesuaikan ketinggian sesuai kebutuhan */
        }
    </style>

     <!-- Main content -->
     <div class="content">
      <div class="container-fluid">
      <div class="card">

          <div class="card-header">
                <h3 class="card-title">Products </h3>
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
              <div class="card-body" style="overflow: auto;">
                <!-- <button data-toggle="modal" data-target="#createModal" class="btn btn-success mb-3" data-whatever="@test">Tambah Produk Baru</button> -->
                <?php if ($success = session('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success ?>
                    </div>
                <?php endif; ?>
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>Produk</th>
                    <th>Foto Produk</th>
                    <th>Harga Produk</th>
                    <th>Stok Sisa</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($products as $att): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $att->nama_product . " (Brand : " . $att->nama_brand . ", warna : " . $att->warna . ", ukuran : " . $att->ukuran .")" ;?></td>
                        <td>
                            <img src="<?= $att->foto_product ?>" width="100px" alt="<?= $att->nama_product ?>">                        
                        </td>
                        <td><?= $att->harga_product; ?></td>
                        <td>
                                <?= $att->stok_total; ?>
                        </td>
                        <td>
                            <button data-toggle="modal" data-target="#cartModal" product_id = "<?= $att->id_product  ?>" product_nama="<?= $att->nama_product  ?>" product_stok="<?= $att->stok_total  ?>" class="btn btn-success cart-btn"><i class="fas fa-shopping-basket p-1"></i>Add To Cart</button>
                        </td>
                    </tr> 
                      <?php endforeach; ?>
                </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama productCategory</th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Shopping Cart</h3>
                </div>
                <div class="card-body">
                  <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) : ?>
                      <div class="empty-cart-message text-center">
                          <h3>There are no items in the shopping cart</h3>
                          <!-- Anda dapat menambahkan ikon atau pesan lainnya di sini untuk menarik perhatian pengguna -->
                      </div>
                  <?php else : ?>
                      <div>
                          <table class="table table-borderless">
                              <thead>
                                  <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Id Produk</th>
                                      <th scope="col">Nama Produk</th>
                                      <th scope="col">Harga Per Unit</th>
                                      <th scope="col">Jumlah</th>
                                      <th scope="col">Total Harga</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php $i = 1; ?>
                                  <?php foreach ($_SESSION['cart'] as $item) : ?>
                                    <tr>
                                          <th scope="row"><?= $i ?></th>
                                          <td><?= $item['id_product'] ?></td>
                                          <td><?= $item['nama_product'] ?></td>
                                          <td><?= $rupiahFormatter->formatRupiah($item['harga_unit'])  ?></td>
                                          <td><?= $item['jumlah'] ?></td>
                                          <td><?= $rupiahFormatter->formatRupiah($item['total_harga']) ?></td>
                                        </tr>
                                      <?php $i++; ?>
                                  <?php endforeach; ?>
                              </tbody>
                          </table>
                          <form action="<?= site_url('transactions/checkout') ?>" method="post">
                            <!-- Tambahkan data produk dari sesi sebagai input tersembunyi dalam form -->
                            <?php foreach ($_SESSION['cart'] as $item) : ?>
                                <input type="hidden" name="id_product[]" value="<?= $item['id_product'] ?>">
                                <input type="hidden" name="jumlah[]" value="<?= $item['jumlah'] ?>">
                                <input type="hidden" name="harga_per_unit[]" value="<?= $item['harga_unit'] ?>">
                                <input type="hidden" name="total_harga[]" value= "<?=  $item['total_harga'] ?>">
                            <?php endforeach; ?>

                            <!-- Tambahkan tombol untuk mengirimkan data ke proses transaksi -->
                            <div class="d-flex justify-content-end">
                                <!-- Gunakan class "ml-auto" pada tombol "Checkout" untuk memposisikannya di sebelah kanan -->
                                <button type="submit" class="btn btn-primary ml-auto">Checkout <span><?= $rupiahFormatter->formatRupiah($_SESSION['total_transaksi'])?></span></button>
                            </div>
                        </form>
                      </div>
                  <?php endif; ?>
              </div>


        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

<!-- //* Card Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product To Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate method="post" action="/transactions/addToCart">
          <?php csrf_field() ?>
          <div class="form-group">
            <label for="nama-attribut" class="col-form-label">Nama Produk</label>
            <input  type="hidden" class="form-control" id="cart_id" name="id_product">
            <input  type="text" class="form-control" disabled id="cart_nama" name="nama_product">
          </div>
          <div class="form-group">
            <label for="nama-attribut" class="col-form-label">Jumlah (Maksimal <span id="placeholderstok"></span>)</label>
            <input  type="text" class="form-control"  id="cart_nama" name="jumlah">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("cart-btn")) {
    e.preventDefault();
    const namaAttribute = e.target.getAttribute("product_nama");
    const idAttribute = e.target.getAttribute("product_id");
    const stok = e.target.getAttribute("product_stok");
    console.log(namaAttribute); // Untuk debugging, cek apakah nilai data berhasil diambil
    console.log(stok);
    // Memasukkan nilai data ke dalam input di dalam modal
    document.getElementById("cart_nama").value = namaAttribute;
    document.getElementById("cart_id").value = idAttribute;
    document.getElementById("placeholderstok").innerText = stok; 

    // Tampilkan modal
    $('#cartModal').modal('show');
  }
})
</script>


<?= $this->endSection() ?>
