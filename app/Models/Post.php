<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_path',
        'created_at',
        'last_update',
    ];

    public $timestamps = false;

    public const PHOTO_UPLOAD_PATH = 'images/uploads/post/';

    public function prepareData(array $input)
    {

        $user['title'] = htmlspecialchars_decode($input['title'] ?? null);
        //$user['slug'] = htmlspecialchars_decode($input['slug'] ?? null);
        $user['content'] = htmlspecialchars_decode($input['content'] ?? null);

        $user['created_at'] = htmlspecialchars_decode($input['created_at'] ?? now());
        $user['last_update'] = htmlspecialchars_decode($input['last_update'] ?? now());


        return $user;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getPostList(array $input)
    {
        $per_page = $input['per_page']??2;
        $query = self::query();

        if (!empty($input['search'])) {
            $query->where('title', 'like', '%'.$input['search'].'%')
                ->orWhere('slug', 'like', '%'.$input['search'].'%')
                ->orWhere('content', 'like', '%'.$input['search'].'%');
        }

        if (!empty($input['order_by'])) {
            $query->orderBy($input['order_by'], $input['direction']??'asc');
        }

        return $query->paginate($per_page);

    }



}
