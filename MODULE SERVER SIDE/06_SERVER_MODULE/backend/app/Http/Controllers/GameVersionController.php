<?php

namespace App\Http\Controllers;

use App\Models\GameVersion;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class GameVersionController extends Controller
{
    public function download(GameVersion $gameVersion){
        return response()->download(Store::disk('game')->path($gameVersion->storage_path));
    }
}
