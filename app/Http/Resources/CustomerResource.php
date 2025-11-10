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
            "CustomerID" => $this->CustomerID,
            "Number" => $this->Number,
            "Name" => $this->Party->FullName,
            "Mobile" => $this->Party->Mobile,
            "Phone" => $this->CustomerAddress->Address->Phone,
            "AddressID" => $this->CustomerAddress->Address->AddressID,
            "Details" => $this->CustomerAddress->Address->Details,
            "Latitude" => $this->CustomerAddress->Address->Latitude,
            "Longitude" => $this->CustomerAddress->Address->Longitude,
            "RegionalDivisionRef" => $this->CustomerAddress->Address->RegionalDivisionRef,
        ];
    }
}
