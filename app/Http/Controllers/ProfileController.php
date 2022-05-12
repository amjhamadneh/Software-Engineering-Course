<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Picture;
use App\Models\User;

class ProfileController extends Controller
{

    public function show($id){
        $user = User::where('id',$id)->first();
        return view('profile',['id' => $id, 'picture'=>$user->picture, 'name'=>$user->name, 'email'=>$user->email, 'description'=>$user->description, 'userId' => $id]);
    }

    public function edit(Request $request){
        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture');
            $imageName = $imagePath->getClientOriginalName();
            $destinationPath = public_path('/image');
            $imagePath->move($destinationPath, sha1($imageName));
            Auth::user()->picture = sha1($imageName);
            Auth::user()->save();
        }
        Auth::user()->description = !$request->input("description") ? " ": $request->input("description");
        Auth::user()->name = $request->input("name");
        Auth::user()->save();
        return redirect("/profile/" . Auth::id());
    }


    public function upload(Request $request){
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $destinationPath = public_path('/image');
            $imagePath->move($destinationPath, sha1($imageName));
            if(!Picture::where('name',$imageName)->where('user_ID', Auth::user()->id)->exists()){
                $picture = new Picture();
                $picture->name = sha1($imageName);
                $picture->user_ID = Auth::user()->id;
                $picture->visible = '0';
                $picture->save();
            }
        }
        return redirect("/profile/" . Auth::id())->with('message', 'The photo is uploaded');
    }

}
