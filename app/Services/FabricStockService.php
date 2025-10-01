<?php

namespace App\Services;

use App\Models\Fabric;
use App\Repositories\FabricStockRepository;
use Illuminate\Support\Str;

class FabricStockService
{
    protected $fabricStockRepository;

    public function __construct(FabricStockRepository $fabricStockRepository)
    {
        $this->fabricStockRepository = $fabricStockRepository;
    }

    /**
     * @param Fabric $fabric
     * @param array $data
     * @return \App\Models\FabricStock
     * @throws \Exception
     */
    public function createStockTransaction(Fabric $fabric, array $data)
    {
        $balance = $fabric->balance;

        if ($data['transaction_type'] === 'out' && $data['qty'] > $balance) {
            throw new \Exception('The quantity to issue cannot exceed the available balance.');
        }

        $stockData = [
            'fabric_id' => $fabric->id,
            'transaction_type' => $data['transaction_type'],
            'qty' => $data['qty'],
            'barcode' => 'TXN-' . strtoupper(Str::random(10)),
            'remarks' => $data['remarks'] ?? null,
        ];

        return $this->fabricStockRepository->create($stockData);
    }
}
