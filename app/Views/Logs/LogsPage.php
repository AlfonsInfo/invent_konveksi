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
            <h3 class="card-title">Logs Monitor </h3>
        </div>
            <!-- /.card-header -->
        <div class="card-body">
        <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Logs Id</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Action</th>
                    <th>Quantity</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                <tbody>
                    <?php //$i = 1 ?>
                    <?php foreach($logs as $att): ?>
                    <tr>
                        <td><?= $att->id_log ?></td>
                        <td>
                        <div>
                            <img src="<?= $att->foto_user ?>" width="75" class="m-2" style="border-radius: 100px;" alt="<?= $att->nama_product ?>">
                            <div style="display: inline-block;">
                                <h5><?= $att->username; ?></h5>
                                <hr style="border: 1px solid #ccc; margin: 4px 0;">
                                <h6><?= $att->nama_role; ?></h6>
                            </div>
                        </div>
                        <td><?= $att->nama_product; ?></td>
                        <?php if($att->log_action == 'delete' || $att->log_action == 'out' ) : ?>
                            <?php if ($att->log_action == 'out') : ?>
                                <td>
                                    <h5 class="text-danger font-weight-bold"><?= $att->log_action; ?>! <?= $att->deskripsi;?></h5>
                                </td>
                                <?php else : ?>
                                    <td>
                                        <h5 class="text-danger font-weight-bold"><?= $att->log_action; ?>!</h5>
                                    </td>
                            <?php endif ?>
                        <?php elseif ($att->log_action == 'update') : ?>
                            <td>
                                <h5 class="text-primary font-weight-bold"><?= $att->log_action; ?>!</h5>
                            </td>
                        <?php else : ?>
                            <td>
                                <h5 class="text-success font-weight-bold"><?= $att->log_action; ?>!</h5>
                            </td>
                        <?php endif ?>
                        <td><?= $att->quantity; ?></td>
                        <td><?= $att->date; ?></td>
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
