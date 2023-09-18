<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'USER';
    protected $primaryKey = 'nik_user'; 
    protected $guarded = ['id'];
    public $timestamps = false;

}
