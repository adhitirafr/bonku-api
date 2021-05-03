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
            // 'deptor' => $this->deptor,
            'original_dept' => format_uang($this->original_dept),
            'interest' => $this->interest,
            'dept_until' => tglIndo($this->dept_until),
            'note' => $this->note,
            'created_at' => tglIndo($this->created_at),
            'updated+at' => tglIndo($this->updated_at),
            'total_dept' => format_uang($this->total_dept),
        ];
    }
}
