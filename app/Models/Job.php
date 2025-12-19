<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'tb_job';
    protected $primaryKey = 'id_job';

    protected $fillable = [
        'id_board', 'deskripsi', 'ck_job'
    ];

    // Relasi: Job milik 1 Board
    public function board()
    {
        return $this->belongsTo(Board::class, 'id_board');
    }
}