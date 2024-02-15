<?php

namespace App\Http\Controllers;

use App\Http\Requests\GifStoreRequest;
use App\Http\Requests\SearchByQueryRequest;
use App\Models\FavoriteGif;
use App\Services\GIFSearcherI;
use App\Services\GIPHYClient;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchGIFController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchByQueryRequest $request, GIFSearcherI $client)
    {
        $response = $client->searchByQuery(...$request->validated());
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GifStoreRequest $request)
    {
        $favorite = FavoriteGif::create($request->validated());
        return response()->json(new JsonResource($favorite));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GIFSearcherI $client)
    {
        $response = $client->searchById($id);
        return response()->json($response);
    }
}
