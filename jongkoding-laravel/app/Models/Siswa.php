<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // protected $connection = 'sqlite'; // jika ingin memakai db berbeda dri default

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    
    // untuk field primary
    // public $incrementing = false;
    // protected $keyType = 'string';

    public $timestamps = false;


    protected $fillable = [
        'nis',
        'nama',
        'jk',
        'alamat',
        'tmp_lahir',
        'tgl_lahir',
        'telepon',
        'id_jurusan'
    ];
    
}
