<?php

namespace App\Helpers;

use App\Models\FabricStock;
use Illuminate\Support\Facades\DB;

if (!function_exists('App\Helpers\calculateFabricBalance')) {
    /**
     * Calculate the stock balance for a given fabric.
     *
     * @param int $fabricId
     * @return float
     */
    function calculateFabricBalance($fabricId)
    {
        $stockIn = FabricStock::where('fabric_id', $fabricId)
            ->where('transaction_type', 'in')
            ->sum('qty');

        $stockOut = FabricStock::where('fabric_id', $fabricId)
            ->where('transaction_type', 'out')
            ->sum('qty');

        return (float)($stockIn - $stockOut);
    }
}