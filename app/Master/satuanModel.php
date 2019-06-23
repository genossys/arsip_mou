<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class satuanModel extends Model
{
    //
    protected $table = 'tb_satuan';
    protected $fillable = ['kdSatuan', 'namaSatuan'];
    protected $primaryKey = 'kdSatuan';
    public $incrementing = false;
    public $timestamps = false;
}
