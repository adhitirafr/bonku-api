<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Log;

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
            'email' => $this->email ? $this->email : '',
            'phone_number' => $this->phone_number ? $this->phone_number : '',
            'identity' => $this->identity ? $this->identity : '',
            'address' => $this->address ? $this->address : '',
            'note' => $this->note? $this->note : '',
            'total_dept' => format_uang($this->totalDept($this->dept)),
        ];
    }

    private function totalDept($datas)
    {
        $total = 0;

        foreach($datas as $data) {
            $total += $data->total_dept;
        }

        return $total;
    }
}
