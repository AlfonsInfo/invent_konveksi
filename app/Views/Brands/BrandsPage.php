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
                <h3 class="card-title">Brand List</h3>
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
                <button data-toggle="modal" data-target="#createModal" class="btn btn-success mb-3" data-whatever="@test">Create Brands</button>
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>Nama Brand</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($brands as $b): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $b['nama_brand']; ?></td>
                        <td>
                            <div>
                                <button  data-toggle="modal" data-target="#updateModal" class="btn btn-warning  edit-btn active " role="button" aria-pressed="true" data-id-attribut="<?= $b['id_brand'];?>" data-nama-attribut="<?= $b['nama_brand'];?>">Edit</button>
                                <button class="btn btn-danger active delete-btn-brand"data-brand-id="<?= $b['id_brand'];?>" role="button" aria-pressed="true"  data-attribute-nama="<?= $b['nama_brand']?>" >Delete</button>
                                <!-- <button>Hapus</button> -->
                              </div>
                            </td>
                          </tr> 
                      <?php endforeach; ?>
                </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Attributes</th>
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
        <h5 class="modal-title" id="exampleModalLabel"><?= 'Tambah Brand' ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <form class="needs-validation" novalidate method="post" action="/brands/create">
          <?= csrf_field(); ?>
          <div class="form-group">
            <label for="nama_brand" class="col-form-label">Nama Brand</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_brand')) ? 'is-invalid' : '' ?>" id="nama_brand" name="nama_brand" autofocus>
            <div class="invalid-feedback">
              <?= $validation->getError('nama_brand') ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Attribute</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Create Brands</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate method="post" action="/brands/update">
          <?php csrf_field() ?>
          <div class="form-group">
            <label for="nama-attribut" class="col-form-label">Nama Brand</label>
            <input  type="hidden" class="form-control" id="edit-id-attribut" name="id_brand">
            <input  type="text" class="form-control" id="edit-nama-attribut" name="nama_brand">
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
   document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("edit-btn")) {
    e.preventDefault();
    const namaAttribute = e.target.getAttribute("data-nama-attribut");
    const idAttribute = e.target.getAttribute("data-id-attribut");
    console.log(namaAttribute); // Untuk debugging, cek apakah nilai data berhasil diambil

    // Memasukkan nilai data ke dalam input di dalam modal
    document.getElementById("edit-nama-attribut").value = namaAttribute;
    document.getElementById("edit-id-attribut").value = idAttribute;

    // Tampilkan modal
    $('#updateModal').modal('show');
  }
})
</script>


<?= $this->endSection() ?>
