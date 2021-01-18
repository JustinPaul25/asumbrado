<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
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
            'amount' => $this->amount,
            'lot' => $this->lot,
            'or_no' => $this->or_no,
            'recievable' => $this->total_recievable,
            'balance' => $this->balance,
            'applicant' => $this->applicant,
            'created_at' => $this->created_at
        ];
    }
}
