<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RegencyCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(
            fn ($regency) => [
                'id' => $regency->id,
                'text' => ucwords(strtolower($regency->name))
            ]
        );
    }
}
