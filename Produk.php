<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    // Menentukan primary key kustom
    protected $primaryKey = 'id_produk';

    /**
     * Field yang boleh diisi (Mass Assignment).
     */
    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'harga',
        'status_produk',
        'foto_produk', // Tambahan untuk simpan nama file foto
    ];
}