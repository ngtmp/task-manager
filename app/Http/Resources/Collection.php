<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public static $wrap = null;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ( null !== $this->additional ) {
            return ($this->collection->map(fn ($value) => $value instanceof Resource ? $value->additional($this->additional) : $value))->toArray();
        }
        return $this->collection->toArray();
    }

    /**
     * Customize the pagination information for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array $paginated
     * @param  array $default
     * @return array
     */
    public function paginationInformation($request, $paginated, $default)
    {
        unset($default['links']);
        unset($default['meta']['links']);

        return $default;
    }
}
