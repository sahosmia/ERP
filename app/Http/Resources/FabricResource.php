<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FabricResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fabric_no' => $this->fabric_no,
            'composition' => $this->composition,
            'gsm' => $this->gsm,
            'qty' => $this->qty,
            'cuttable_width' => $this->cuttable_width,
            'production_type' => $this->production_type,
            'image_url' => $this->image_path ? asset('storage/' . $this->image_path) : null,
            'barcode' => $this->barcode,
            'balance' => $this->balance, // Assumes the 'balance' attribute is available on the model
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}