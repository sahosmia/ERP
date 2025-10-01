<?php

namespace App\Repositories;

use App\Models\FabricStock;

class FabricStockRepository
{

    public function create(array $data): FabricStock
    {
        return FabricStock::create($data);
    }
}
