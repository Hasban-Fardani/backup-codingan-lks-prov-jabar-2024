<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;

class AdministratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        return response()->json([
            "totalElements" => Administrator::count(),
            "content" => Administrator::all()
        ]);
    }
}
