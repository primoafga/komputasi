<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_Mapel extends Model
{
    use HasFactory;

    protected $table = 'daftar_mapel';
    protected $fillable = ['NAMA',
                            'KETERANGAN'];
}
