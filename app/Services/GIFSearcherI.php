<?php

namespace App\Services;

interface GIFSearcherI
{
    public function searchByQuery(string $query, ?int $limit = 10, ?int $offset = 0);

    public function searchById(string $id);

    public function searchByFavorite();
}
