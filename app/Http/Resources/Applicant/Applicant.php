<?php

namespace App\Http\Resources\Applicant;

use Illuminate\Http\Resources\Json\JsonResource;

class Applicant extends JsonResource
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
            'date_applied' => $this->date_applied,
            'address' => $this->address,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'occupation' => $this->occupation,
            'employers_name' => $this->employers_name,
            'civil_status' => $this->civil_status,
            'spouse' => $this->spouse,
            'reference_one_name' => $this->reference_one_name,
            'reference_one_address' => $this->reference_one_address,
            'reference_one_mobile_no' => $this->reference_one_mobile_no,
            'reference_one_relationship' => $this->reference_one_relationship,
            'reference_two_name' => $this->reference_two_name,
            'reference_two_address' => $this->reference_two_address,
            'reference_two_mobile_no' => $this->reference_two_mobile_no,
            'reference_two_relationship' => $this->reference_two_relationship,
            'lot' => $this->lots[0],
            'agent' => $this->lots[0]->agent,
            'payments' => $this->payments
        ];
    }
}
