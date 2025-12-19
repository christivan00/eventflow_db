<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $table = 'tb_board';
    protected $primaryKey = 'id_board';

    protected $fillable = [
        'id_user', 'board_name', 'dl_start', 'dl_finsh', 'bg'
    ];

    // Relasi: Board milik 1 User
    public function user()
    {
        return $this->belongsTo(UserCustom::class, 'id_user');
    }

    // Relasi: 1 Board punya banyak Job
    public function jobs()
    {
        return $this->hasMany(Job::class, 'id_board');
    }
}