<?php

namespace App\Http\Resources;

use App\Manager\ImageManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
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
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'age'=>$this->age,

            'display_photo'=> ImageManager::prepareImageUrl(User::PHOTO_UPLOAD_PATH, $this->picture_path),


        ];
    }
}
