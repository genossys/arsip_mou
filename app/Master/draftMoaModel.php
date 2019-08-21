<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class draftMoaModel extends Model
{
    //
    protected $table = 'tb_draftmoa';
    protected $fillable = [
        'id','mitra', 'nomorMou', 'namaKegiatan','keterangan','nomorMoaMitra', 'tanggalPembuatan', 'tanggalExpired', 'file','status','nomorMoaUdb'
    ];
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
}
