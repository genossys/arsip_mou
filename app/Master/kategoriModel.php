<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class kategoriModel extends Model
{
    //
    protected $table = 'tb_kategori';
    protected $fillable = ['kdKategori', 'namaKategori'];
    protected $primaryKey = 'kdKategori';
    public $incrementing = false;
    public $timestamps = false;
}
