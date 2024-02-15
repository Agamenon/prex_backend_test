<?php

namespace App\Services;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class GIPHYClient implements GIFSearcherI{

    protected $token;

    protected $url;

    public function __construct()
    {
        $this->url = env("GIPHY_API_URL");
        $this->token = env("GIPHY_API_TOKEN");
    }
    public function searchByQuery(string $query, ?int $limit = 10, ?int $offset = 0){
        $response = Http::get("$this->url/search",["api_key" => $this->token,"q" => $query, "limit" => $limit, "offset" =>$offset, "bundle" => "messaging_non_clips"]);
        return new JsonResource($response->json("data"));
    }

    public function searchById(string $id){
        $response = Http::get("$this->url/{$id}", ["api_key" => $this->token]);
        return new JsonResource($response->json("data"));
    }

    public function searchByFavorite(){

    }

}