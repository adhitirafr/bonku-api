<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeptResource extends JsonResource
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
            'deptor' => $this->deptor,
            'original_dept' =>$this->original_dept,
            'interest' => $this->interest ? $this->interest : '',
            'dept_until' => $this->dept_until ? $this->dept_until : '',
            'note' => $this->note ? $this->note : '',
            'total_dept' => $this->total_dept,
        ];
    }
}
