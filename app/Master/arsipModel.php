<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class arsipModel extends Model
{
    //
    protected $table = 'tb_arsip';
    protected $fillable = [
        'id', 'jenisArsip', 'nomorArsip', 'mitra', 'file'
    ];
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
}
