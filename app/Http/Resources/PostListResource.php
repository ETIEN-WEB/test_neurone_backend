<?php

namespace App\Http\Resources;

use App\Manager\ImageManager;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'slug'=>$this->slug,
            'content'=>$this->content,

            'display_photo'=> ImageManager::prepareImageUrl(Post::PHOTO_UPLOAD_PATH, $this->image_path),


        ];
    }
}
