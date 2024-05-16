<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public  function version() {
        return $this->hasMany(GameVersion::class);
    }

    public function score(){
        return $this->HasMany(Score::class);
    }
}
