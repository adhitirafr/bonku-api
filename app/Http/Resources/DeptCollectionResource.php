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
                'name' => $this[$i]->deptor->name,
                'original_dept' => format_uang($this[$i]->original_dept),
                'interest' => $this[$i]->interest ? $this[$i]->interest : '',
                'dept_until' => $this[$i]->dept_until ? tglIndo($this[$i]->dept_until): '',
                'note' => $this[$i]->note ? $this[$i]->note : '',
                'created_at' => tglIndo($this[$i]->created_at),
            ]);
        }
        return $data;
    }
}
