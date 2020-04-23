<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aksi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tipe',
        'judul',
        'deskripsi',
        'tanggal',
        'kategori_id',
        'jumlah_penerima',
        'jumlah_personil',
        'nama_lembaga',
        'nama_penanggungjawab',
        'tlp_penanggungjawab',
        'email_penanggungjawab',
        'sektor',
        'sektor_lain',
        'spesialisasi',
        'log_lat',
        'alamat',
        'tautan_berita',
        'tautan_video',
        'foto',
        'status',
    ];
}
