<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $fillable = ['NIG',
                            'NAMA',
                            'ALAMAT',
                            'STATUS',
                            'MENGAJAR',
                            'password'];
}
