<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostEditResource;
use App\Http\Resources\PostListResource;
use App\Manager\ImageManager;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
    public function store(StorePostRequest $request)
    {
        //
        $check_post = Post::where('title', $request->title)->count();
        if ($check_post >= 1 ) {
            return response()->json(["msg"=>"Cet titre existe déjà", 'retour' => 0, "cls"=>"warning", 'lag'=>'true']);
        }
        $post_data = (new Post())->prepareData($request->all());

        if ($request->has('image_path')){
            $name = Str::slug('post'.now().'-photo');
            $post_data['image_path'] = ImageManager::processImageUpload(
                $request->input('image_path'),
                $name,
                Post::PHOTO_UPLOAD_PATH
            );
        }

        try {
            DB::beginTransaction();
            $post = Post::create($post_data);

            DB::commit();
            //return $post;
            return response()->json(["msg"=>"Post creé avec succès",
                "cls"=>"success", 'retour' => 1]);

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
        $post = Post::where('id', $post->id)->first();
        if (!$post){
            return response()->json(["msg"=>"Aucun post ne correspond.", "cls"=>"warning", 'lag'=>'true']);
        }

        return new PostEditResource($post);

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

        //return $request->all();

        // Check if the post title is alredy used
        $post_existe = Post::where('id', '!=', $post->id)->where('title', $request->title)->count();
        if ($post_existe >= 1 ){
            return response()->json(["msg"=>"Cet titre existe déjà", 'retour' => 0, "cls"=>"warning", 'lag'=>'true']);
        }

        $post_data = (new Post())->prepareData($request->all());

        if ($request->has('image_path')){
            $name = Str::slug('post'.now().'-photo');
            $post_data['image_path'] = ImageManager::processImageUpload(
                $request->input('image_path'),
                $name,
                Post::PHOTO_UPLOAD_PATH,
                $post->photo

            );
        }

        //return $post_data;
        try {
            DB::beginTransaction();
            $post->update($post_data);

            DB::commit();
            //return $post;
            return response()->json(["msg"=>"Post modifié avec succès",
                "cls"=>"success", 'retour' => 1]);

        }catch (\Throwable $e){
            DB::rollBack();
            return response()->json(["msg"=>"Quelque chose s'est mal passée", 'retour' => 0, "cls"=>"warning", 'lag'=>'true']);
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!empty($brand->logo)) {
            ImageManager::deletePhoto(Brand::IMAGE_UPLOAD_PATH, $post->image_path);

        }

        $post->delete();
        return response()->json(["msg"=>"Post supprimée avec succès",
            "cls"=>"warning"
        ]);
    }
}
