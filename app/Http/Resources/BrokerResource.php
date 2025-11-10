<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrokerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "BrokerID"=>$this->BrokerID,
            "Number"=>$this->Number,
            "FirstName"=>$this->Party->FirstName,
            "LastName"=>$this->Party->LastName,
            "FatherName"=>$this->Party->FatherName,
            "Mobile"=>$this->Party->Mobile,
        ];
    }
}
