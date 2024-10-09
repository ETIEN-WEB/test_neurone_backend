<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserAuthResource;
use App\Manager\ImageManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function inscription(SignupRequest $request)
    {
        //return $request->all();

        $check_user = User::where('email', $request->email)->count();
        if ($check_user >= 1 ) {
            throw ValidationException::withMessages([
                'email' => ['Ce mail est déjà utilisé!']
            ]);
        }

        $user_data = (new User())->prepareData($request->all());
        if ($request->has('picture_path')){
            $name = Str::slug($user_data['first_name'].now().'-photo');
            $user_data['picture_path'] = ImageManager::processImageUpload(
                $request->input('picture_path'),
                $name,
                User::PHOTO_UPLOAD_PATH
            );
        }

        try {
            DB::beginTransaction();
            $user = User::create($user_data);
            //return $user;

            DB::commit();
            return response()->json(["msg"=>"Votre compte a été creé avec succès",
                "cls"=>"success", 'retour' => 1, 'email'=>$user->email]);

        }catch (\Throwable $e){
            DB::rollBack();
            return response()->json(["msg"=>"Quelque chose s'est mal passée", 'retour' => 0, "cls"=>"warning", 'lag'=>'true']);
        }
    }

    public function login (LoginRequest $request)
    {
        //return $request->all();

        $credentials = $request->validated();
        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'erreur' => ['Les informations entrées ne sont pas correctes']
            ]);
        }

        $user = Auth::user();
        //$user = User::where('id', $id)->where('role_id', 5)->first();
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => new UserAuthResource($user),
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response([
            'success' => true
        ]);

    }



}
