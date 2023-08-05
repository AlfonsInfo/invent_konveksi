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
              <div class="card-body">
                <a href="/products/createpage" class="btn btn-primary">Tambah Produk Baru</a>
                <!-- <button data-toggle="modal" data-target="#createModal" class="btn btn-success mb-3" data-whatever="@test">Tambah Produk Baru</button> -->
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Brand</th>
                    <th>Warna</th>
                    <th>Ukuran</th>
                    <th>Foto Produk</th>
                    <th>Harga Produk</th>
                    <th>Stok Total</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($products as $att): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $att->nama_product; ?></td>
                        <td><?= $att->nama_category; ?></td>
                        <td><?= $att->nama_brand; ?></td>
                        <td><?= $att->warna; ?></td>
                        <td><?= $att->ukuran; ?></td>
                        <td>
                            <img src="<?= $att->foto_product ?>" width="200px" alt="<?= $att->nama_product ?>">                        
                        </td>
                        <td><?= $att->harga_product; ?></td>
                        <td>
                            <div>
                                <?= $att->stok_total; ?>
                            </div>
                                <button  data-product-id="<?= $att->id_product;?>" class="btn btn-primary adding-btn">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <!-- Add the 'minus-btn' class to the button element -->
                                <button data-product-id="<?= $att->id_product; ?>" class="btn btn-primary minus-btn">
                                    <!-- Wrap the icon with a span element and add the 'minus-icon' class -->
                                    <span data-product-id="<?= $att->id_product; ?>" class="minus-icon">
                                        <i class="fas fa-minus"></i>
                                    </span>
                                </button>
                        </td>
                        <td>
                            <div>
                            <a href="products/editpage/<?= $att->id_product;?>"   class="btn btn-warning   " role="button"   >Edit</a>
                            <button class="btn btn-danger active delete-btn-product" data-product-id="<?= $att->id_product;?>" role="button" aria-pressed="true"  data-attribute-nama="<?= $att->nama_product ?>" >Delete</button>
                          </div>
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

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

<!-- //* Adding -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <form class="needs-validation" novalidate method="post" action="/products/updatestok">
          <?= csrf_field(); ?>
          <div class="form-group">
            <label for="nama_category" class="col-form-label">Tambah</label>
            <input  type="hidden" class="form-control" id="id_product_add" name="id_product">
            <input  type="hidden" class="form-control"  name="tipe" value="in">
            <input type="number" class="form-control" id="jumlah_tambah" name="jumlah" autofocus>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Konfirmasi</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- //* Kurang-->
<div class="modal fade" id="substractModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kurangi Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <form class="needs-validation" novalidate method="post" action="/products/updatestok">
          <?= csrf_field(); ?>
          <div class="form-group">
            <label for="jumlah_tambah" class="col-form-label">Kurangi</label>
            <input  type="hidden" class="form-control" id="id_product_minus" name="id_product">
            <input  type="hidden" class="form-control"  name="tipe" value="out">
            <input type="number" class="form-control" id="jumlah_tambah" name="jumlah" autofocus>
          </div>
          <div class="form-group">
            <label for="alasan" class="col-form-label">Alasan Pengurangan Stok</label>
            <input type="text" class="form-control" id="alasan" name="alasan" autofocus>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Konfirmasi</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener("click", function (e) {
      // Assuming you have already added the event listener for the "minus-btn" elements
      if (e.target && (e.target.classList.contains("adding-btn") || e.target.closest(".adding-btn"))) {
                e.preventDefault();
                const idProduct = e.target.getAttribute("data-product-id") || e.target.closest(".adding-btn").getAttribute("data-product-id");

                // Add an event listener for the "shown.bs.modal" event
                $('#addModal').on('shown.bs.modal', function () {
                    // Memasukkan nilai data ke dalam input di dalam modal
                    document.getElementById("id_product_add").value = idProduct;
                    console.log(idProduct);
                });

                // Tampilkan modal
                $('#addModal').modal('show');
            }
  // Assuming you have already added the event listener for the "minus-btn" elements
        if (e.target && (e.target.classList.contains("minus-btn") || e.target.closest(".minus-btn"))) {
            e.preventDefault();
            const idProduct = e.target.getAttribute("data-product-id") || e.target.closest(".minus-btn").getAttribute("data-product-id");

            // Add an event listener for the "shown.bs.modal" event
            $('#substractModal').on('shown.bs.modal', function () {
                // Memasukkan nilai data ke dalam input di dalam modal
                document.getElementById("id_product_minus").value = idProduct;
                console.log(idProduct);
            });

            // Tampilkan modal
            $('#substractModal').modal('show');
        }
  });

</script>


<?= $this->endSection() ?>
