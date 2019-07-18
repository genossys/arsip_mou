<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class mitraModel extends Model
{
    //
    protected $table = 'tb_mitra';
    protected $fillable = [
        'username', 'email', 'password', 'noHp', 'alamat'
    ];
    protected $primaryKey = 'kdArsip';
    public $incrementing = false;
    public $timestamps = false;
}
