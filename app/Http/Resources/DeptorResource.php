<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeptorResource extends JsonResource
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
            'phone_number' => $this->phone_number,
            'identity' => $this->identity,
            'address' => $this->address,
            'note' => $this->note,
            'total_dept' => format_uang(0),
            'depts' => DeptResource::collection($this->dept)
        ];
    }
}
