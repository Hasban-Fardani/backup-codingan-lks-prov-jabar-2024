<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    public $guarded = ['id'];

    public function game(){
        return $this->belongsTo(Game::class);
    }
}
