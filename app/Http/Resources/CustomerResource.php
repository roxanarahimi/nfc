<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "CustomerID"=> $this->CustomerID,
            "Number"=> $this->Number,
            "Name"=> $this->Party->FullName,
            "Mobile"=> $this->Party->Mobile,
            "AddressID"=> $this->CustomerAddress->Address->AddressID,
            "Phone"=> $this->CustomerAddress->Address->Phone,
            "RegionalDivisionRef"=> $this->CustomerAddress->Address->RegionalDivisionRef,
            "Latitude"=> $this->CustomerAddress->Address->Latitude,
            "Longitude"=> $this->CustomerAddress->Address->Longitude,
        ];
    }
}
