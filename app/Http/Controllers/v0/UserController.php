<?php

namespace App\Http\Controllers\v0;

use App\Http\Controllers\Controller;
use App\Http\Requests\v0\ApiUserRequest;
use App\Http\Resources\v0\PublicUserResource;
use App\Http\Resources\v0\UserResource;
use App\Models\User;
use App\Service\ImageService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PublicUserResource(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== $request->user()->id) {
            return response('更新する権限がありません', 403)->header('Content-Type', 'text/plain');
        }
        if ($image = $request->file('icon')) {
            $imageService = new ImageService($image);
            $image_path = $imageService->save($folder = 'users', $file_name = $user->uid);
            $user->icon_url = $image_path;
        }
        $user->fill($request->only(['name', 'email', 'password']))->save();
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== $request->user()->id) {
            return response('削除する権限がありません', 403)->header('Content-Type', 'text/plain');
        }
        $user->delete();
    }
}
