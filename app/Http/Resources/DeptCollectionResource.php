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

        return [
            'id' => $this->id,
            'deptor' => $this->deptor,
            'name' => $this->deptor->name,
            'original_dept' => format_uang($this->original_dept),
            'interest' => $this->interest ? $this->interest : '',
            'dept_until' => $this->dept_until ? tglIndo($this->dept_until): '',
            'note' => $this->note ? $this->note : '',
            'created_at' => tglIndo($this->created_at),
        ];
    }
}
