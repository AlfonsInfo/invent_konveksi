<?php 
        $rupiahFormatter = new \App\Controllers\RupiahFormatter();
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
                <h2 class="card-title">Nomor Struk : <?= $transaction_details[0]->no_struk_transaksi?></h2>
        </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <button data-toggle="modal" data-target="#createModal" class="btn btn-success mb-3" data-whatever="@test">Create Attribute</button> -->
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nomor</th>
                    <th>No Produk</th>
                    <th>Produk</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                  </tr>
                  </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($transaction_details as $item): ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $item->id_product ?></td>
                        <td>
                            <?= $item->nama_product ?>
                            <div>
                                <img src="<?= $item->foto_product ?>" width="200px" alt="<?= $item->nama_product ?>">                        
                            </div>
                        </td>
                        <td>
                            <?= $rupiahFormatter->formatRupiah($item->harga_per_unit)  ?>
                        </td>
                        <td>x<?= $item->jumlah ?></td>
                        <td><?= $rupiahFormatter->formatRupiah($item->total_harga) ?></td>
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


<!-- //* Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= 'Create Attribute' ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate method="post" action="/attributes/update">
          <?php csrf_field() ?>
          <div class="form-group">
            <label for="nama-attribut" class="col-form-label">Nama Attribut</label>
            <input  type="hidden" class="form-control" id="edit-id-attribut" name="id_attribute">
            <input  type="text" class="form-control" id="edit-nama-attribut" name="nama_attribute">
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
