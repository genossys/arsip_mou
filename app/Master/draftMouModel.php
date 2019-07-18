<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class draftMouModel extends Model
{
    //
    protected $table = 'tb_draftmou';
    protected $fillable = [
        'id','mitra', 'nomorMouMitra', 'nomorMouUdb', 'tanggalPembuatan', 'tanggalExpired', 'file','status'
    ];
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
}
