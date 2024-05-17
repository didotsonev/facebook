<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->{Post::ID},
            'description' => $this->{Post::DESCRIPTION},
            'created_at' => $this->{Post::CREATED_AT},
            'updated_at' => $this->{Post::UPDATED_AT},
            'created_by_id' => $this->{Post::CREATED_BY_ID},
        ];
    }
}
