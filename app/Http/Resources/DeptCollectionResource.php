<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeptCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];

        for($i = 0; $i < count($this->all()); $i++) {
            array_push($data, [
                'id' => $this[$i]->id,
                'name' => $this[$i]->name,
                'phone_number' => $this[$i]->phone_number,
                'identity' => $this[$i]->identity,
                'address' => $this[$i]->address,
                'note' => $this[$i]->note,
                'total_dept' => format_uang(0),
            ]);
        }

        return $data;
    }
}
