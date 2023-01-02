<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ppdb extends Model
{
    use HasFactory;
    protected $fillable =[ 
        'name',
        'email',
        'nisn',
        'asalSekolah',
        'jenisKelamin',
        'nomor',
        'noIbu',
        'noAyah',
    ];
}
