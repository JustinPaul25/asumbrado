<?php

namespace App\Http\Resources\Lot;

use Illuminate\Http\Resources\Json\JsonResource;

class Lot extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'block_no' => $this->block_no,
            'lot_no' => $this->lot_no,
            'area' => $this->area,
            'balance' => $this->balance,
            'monthly_payment' => $this->monthly_payment,
            'months' => $this->months,
            'status' => $this->status,
            'total_price' => $this->total_price,
            'applicant' => $this->applicant,
            'agent' => $this->agent,
            'paid' => $this->total_price - $this->balance,
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
