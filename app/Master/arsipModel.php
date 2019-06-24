<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class arsipModel extends Model
{
    //
    protected $table = 'tb_arsip';
    protected $fillable = [
        'kdArsip', 'judulArsip', 'keterangan', 'tanggal', 'urlFile', 'username'
    ];
    protected $primaryKey = 'kdArsip';
    public $incrementing = false;
    public $timestamps = false;
}
