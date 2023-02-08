<?php

namespace App\Http\Resources;

use App\Http\Controllers\SalesmanController;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesmanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $data['display_name'] = sprintf('%s %s %s %s',
            join(' ', $this->resource->titles_before ?? []),
            $this->resource->first_name,
            $this->resource->last_name,
            join(' ', $this->resource->titles_after ?? []),
        );
        $data['self'] = action([SalesmanController::class, 'show'], ['salesman' => $this->resource->id], false);
        return $data;
    }
}
