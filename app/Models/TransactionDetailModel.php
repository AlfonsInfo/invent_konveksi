<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionDetailModel extends Model
{
    protected $table            = 'transaction_details';
    protected $primaryKey       = 'id_detail_transaksi';
    protected $allowedFields    = ['id_transaksi','id_produk','jumlah','harga_per_unit','total_harga'];

}
