<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'deskripsi', 'warna', 'induk', 'status'
    ];
}
