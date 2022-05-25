<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DistrictCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(
            fn ($district) => [
                'id' => $district->id,
                'text' => ucwords(strtolower($district->name))
            ]
        );
    }
}
