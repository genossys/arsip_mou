<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class memberModel extends Model
{
    //
    protected $table = 'tb_member';
    protected $fillable = ['username', 'email', 'password', 'nohp', 'alamat'];
}
