<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCustom extends Model
{
    use HasFactory;

    protected $table = 'tb_user';      // Nama tabel custom
    protected $primaryKey = 'id_user'; // Primary key custom

    protected $fillable = [
        'name_user', 'email_user', 'pass_user'
    ];

    // Relasi: 1 User punya banyak Board
    public function boards()
    {
        return $this->hasMany(Board::class, 'id_user');
    }
}