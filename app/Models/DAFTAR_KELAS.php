<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAFTAR_KELAS extends Model
{
    use HasFactory;

    protected $table = 'daftar_kelas';
    protected $fillable = ['NAMA',
                            'ID_WALI_KELAS',
                            'TINGKAT'];
}
