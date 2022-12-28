<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_UH extends Model
{
    use HasFactory;

    protected $table = 'daftar_uh';
    protected $fillable = ['ID_GURU',
                            'ID_MAPEL',
                            'ID_KELAS',
                            'NAMA'];
}
