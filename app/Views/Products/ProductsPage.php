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
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button class="btn btn-primary">
                                    <i class="fas fa-minus"></i>
                                </button>
                        </td>
                        <td>
                            <div>
                            <a href="products/editpage/<?= $att->id_product;?>"   class="btn btn-warning  edit-btn active " role="button"   >Edit</a>
                            <button class="btn btn-danger active delete-btn"data-product-id="<?= $att->id_product;?>" role="button" aria-pressed="true"  data-attribute-nama="<?= $att->nama_product ?>" >Delete</button>
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

<!-- //* Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <form class="needs-validation" novalidate method="post" action="/productcategory/create">
          <?= csrf_field(); ?>
          <div class="form-group">
            <label for="nama_category" class="col-form-label">Nama Kategori</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_category')) ? 'is-invalid' : '' ?>" id="nama_category" name="nama_category" autofocus>
            <div class="invalid-feedback">
              <?= $validation->getError('nama_category') ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah Kategori</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- //* Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= 'Update Category' ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate method="post" action="/productcategory/update">
          <?php csrf_field() ?>
          <div class="form-group">
            <label for="nama-attribut" class="col-form-label">Nama Kategori</label>
            <input  type="hidden" class="form-control" id="edit-id-attribut" name="id_category">
            <input  type="text" class="form-control" id="edit-nama-attribut" name="nama_category">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Saved Changed</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
</script>


<?= $this->endSection() ?>
