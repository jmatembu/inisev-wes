<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebsiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $websiteDetails = parent::toArray($request);
        $websiteDetails['subscribers'] = UserResource::collection($this->whenLoaded('subscribers'));
        $websiteDetails['posts'] = PostResource::collection($this->whenLoaded('posts'));

        return $websiteDetails;
    }
}
