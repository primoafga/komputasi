<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kbm extends Model
{
    use HasFactory;

    protected $table = 'kbm';
    protected $fillable = ['ID_GURU',
                            'ID_KELAS',
                            'ID_MAPEL'];
}
