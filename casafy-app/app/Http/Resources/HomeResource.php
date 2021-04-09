<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OwnerResource;
use Carbon\Carbon;

class HomeResource extends JsonResource
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
            'id' => $this->resource->id,
            'address' => $this->resource->address,
            'bedrooms' => $this->resource->bedrooms,
            'bathrooms' => $this->resource->bathrooms,
            'total_area' => $this->resource->total_area,
            'purcharsed' => $this->resource->purcharsed,
            'value' => $this->resource->value,
            'discount' => $this->resource->discount,
            'owner_id' => (new OwnerResource($this->resource->owner))->id,
            'expired' => Carbon::now()->subMonths(3)->gt($this->resource->created_at),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
