<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Import DB untuk menjalankan query manual (Auto Numbering)
use Illuminate\Support\Facades\DB;

class Topping extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara spesifik
    protected $table = 'topping';

    // Mengizinkan semua kolom diisi (Mass Assignment)
    protected $guarded = [];

    /**
     * Fungsi untuk generate kode topping otomatis
     * Hasil: TP001, TP002, dst.
     */
    public static function getKodeTopping()
    {
        // Query untuk mengambil kode topping tertinggi, default ke TP000 jika tabel kosong
        $sql = "SELECT IFNULL(MAX(kode_topping), 'TP000') as kode_topping 
                FROM topping";
        $kodetopping = DB::select($sql);

        // Ambil hasil dari query
        $kd = 'TP000'; // Nilai default awal
        foreach ($kodetopping as $kdtp) {
            $kd = $kdtp->kode_topping;
        }

        // Mengambil 3 digit terakhir (angka)
        $noawal = substr($kd, -3);
        
        // Menambahkan 1 ke angka tersebut
        $noakhir = (int)$noawal + 1; 

        // Gabungkan kembali: TP + Angka yang sudah diberi padding nol di kiri (3 digit)
        $noakhir = 'TP' . str_pad($noakhir, 3, "0", STR_PAD_LEFT); 
        
        return $noakhir;
    }

    /**
     * Mutator: Otomatis membersihkan titik pada harga sebelum simpan ke DB
     * Contoh: Input "5.000" menjadi 5000 di database
     */
    public function setHargaToppingAttribute($value)
    {
        // Hapus tanda titik jika ada (format ribuan Indonesia)
        $this->attributes['harga_topping'] = str_replace('.', '', $value);
    }
}