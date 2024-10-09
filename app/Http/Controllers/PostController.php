<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostListResource;
use App\Manager\ImageManager;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = (new Post())->getPostList($request->all());
        ///return $posts;

        return PostListResource::collection($posts);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * StorePostRequest
     */
    public function store(Request $request)
    {
        //
        //return $request->all();
        /*return response([
            'personnes' => 'personnes'
        ]);*/

        /*return response()->json([
            'categories'=>'ok',

        ]);*/

        $post_data = (new Post())->prepareData($request->all());

        if ($request->has('image_path') && !empty($request->input('image_path'))){
            $name = Str::slug('post'.now().'-photo');
            $post_data['image_path'] = ImageManager::processImageUpload(
                $request->input('image_path'),
                $name,
                Post::PHOTO_UPLOAD_PATH
            );
        }
        $post = Post::create($post_data);
        return $post;

        try {
            DB::beginTransaction();
            $post = Post::create($post_data);

            DB::commit();
            return $post;
            /*return response()->json(["msg"=>"Post creé avec succès",
                "cls"=>"success", 'retour' => 1, 'email'=>$user->email]);*/

        }catch (\Throwable $e){
            DB::rollBack();
            return response()->json(["msg"=>"Quelque chose s'est mal passée", 'retour' => 0, "cls"=>"warning", 'lag'=>'true']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
