<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class mitraModel extends Model
{
    //
    protected $table = 'tb_mitra';
    protected $fillable = [
        'username', 'email', 'password', 'noHp', 'alamat','fileSurat','status'
    ];
    protected $primaryKey = 'username';
    public $incrementing = false;
}
