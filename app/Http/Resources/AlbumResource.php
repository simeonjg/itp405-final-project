<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class AlbumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->AlbumId, // $this->resource->AlbumId
            'title' => $this->Title,
            'artist' => new ArtistResource($this->whenLoaded('artist')),
            'tracks' => TrackResource::collection($this->whenLoaded('tracks')),
        ];
    }
}
