<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 0);
        $size = $request->input('size', 10);
        $sortBy = $request->input('sortBy', 'title');
        $sortDir = $request->input('sortDir', 'asc');

        $games = Game::query();

        $games->orderBy($sortBy, $sortDir);
        $offset = $page > 0 ? ($page-1) * $size: 0;
        $games->offset($offset);
        $games->limit($size);

        return response()->json([
            'page' => $page,
            'size' => $size,
            'totalElements' => $games->count(),
            'content' => $games->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:60',
            'description' => 'required|min:5|max:200'
        ]);

        $data = $validator->validated();
        $generatedSlug = str_replace(' ', '-', strtolower($data['title'])) ;
        $slugExists = Game::where('slug', $generatedSlug)->first();
        if ($slugExists) {
            return response()->json([
                'status' => 'invalid',
                'slug' => 'Game title already exists'
            ], 400);
        }

        $data['slug'] = $generatedSlug;
        $data['created_by'] = auth()->user()->id;
        $data['thumbnail'] = "/games/:slug/:version/thumbnail.png";

        $game = Game::create($data);

        return response()->json([
            'status' => 'success',
            'slug' => $game->slug
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return response()->json([

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }

    public function upload(Request $request) {
        $validator = Validator::make($request->all(), [
            'file'
        ]);
    }
}
