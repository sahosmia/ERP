<?php

namespace App\Helpers;

use App\Models\FabricStock;

function calculateFabricBalance($fabricId)
{
    $stockIn = FabricStock::where('fabric_id', $fabricId)
        ->where('transaction_type', 'in')
        ->sum('qty');

    $stockOut = FabricStock::where('fabric_id', $fabricId)
        ->where('transaction_type', 'out')
        ->sum('qty');

    return $stockIn - $stockOut;
}