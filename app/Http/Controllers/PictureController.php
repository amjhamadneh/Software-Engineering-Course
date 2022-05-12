<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Picture;
use App\Models\User;
use App\Models\UserSavePicture;
use App\Models\Comment;
use App\Models\UserLikePicture;
use App\Models\Notification;

class PictureController extends Controller
{

    public function privacy(Request $request){
        $picture = Picture::where('id', $request->id)->where('user_ID', Auth::user()->id)->first();
        if($picture) {
            if ($picture->visible == 1)
                $picture->visible = 0;
            else
                $picture->visible = 1;
            $picture->save();
        }
        return response()->json(['success'=>true]);
    }

    public function deleteComment(Request $request){
        Comment::where('id', $request->id)->where('user_ID', Auth::user()->id)->delete();
        return response()->json(['success'=>true]);
    }

    public function addComment(Request $request){
        $picture = Picture::where('id', $request->id)->first();
        $comment = new Comment();
        $comment->content = $request->note;
        $comment->picture_ID = $picture->id;
        $comment->user_ID = Auth::user()->id;
        $comment->save();

        $notification = new Notification();
        $notification->user_ID = Auth::user()->id;
        $notification->picture_ID = $picture->id;
        $notification->visited = 0;
        $notification->comment_ID = $comment->id;
        $notification->type = 0; //comment
        $notification->save();

        return response()->json(['success'=>true]);
    }

    public function view(Request $request){
        $picture = Picture::where('id', $request->id)->first();
        $isLiked = UserLikePicture::where('user_ID', Auth::user()->id)->where('picture_ID', $picture->id)->exists();
        $isSaved = UserSavePicture::where('user_ID', Auth::user()->id)->where('picture_ID', $picture->id)->exists();
        $userPicture = User::where('id', $picture->user_ID)->first();
        $comments = Comment::all()->where('picture_ID', $picture->id);
        $commentsResult = array();

        foreach ($comments as $comment) {
            $userComment = User::where('id',$comment->user_ID)->first();
            array_push($commentsResult, ['userComment' => $userComment, 'comment' => $comment]);
        }

        if(!empty($request->notificationID)){
            $note = Notification::where('id', $request->notificationID)->first();
            $note->visited = 1;
            $note->save();
        }
        return response()->json(['success'=> true, 'picture' => $picture, 'user' => $userPicture, 'comments' => $commentsResult, 'isLiked' => $isLiked, 'isSaved' => $isSaved]);
    }

    public function delete(Request $request) {
        $picture = Picture::where('id', $request->id)->first();
        UserSavePicture::where('picture_ID', $picture->id)->delete();
        Notification::where('picture_ID', $picture->id)->delete();
        Comment::where('picture_ID', $picture->id)->delete();
        Picture::where('id', $request->id)->delete();
        return response()->json(['success' => true]);
    }

    public function getMyPhotos(Request $request) {
        $pictures = Picture::all()->where('user_ID', $request->id);
        $resultPictures = array();
        foreach ($pictures as $picture) {
            $isLiked = UserLikePicture::where('user_ID', Auth::user()->id)->where('picture_ID', $picture->id)->exists();
            $isSaved = UserSavePicture::where('user_ID', Auth::user()->id)->where('picture_ID', $picture->id)->exists();
            array_push($resultPictures, ['picture' => $picture, 'isLiked' => $isLiked, 'isSaved' => $isSaved]);
        }
        return view('my-photos', ['pictures'=> $resultPictures, 'userId' => $request->id ]);
    }

    public function getSavedPhotos(Request $request){
        $savedPictures = UserSavePicture::all()->where('user_ID', $request->id);
        $resultPictures = array();
        foreach ($savedPictures as $savedPicture) {
            $picture = Picture::where('id', $savedPicture->picture_ID)->first();
            array_push($resultPictures, ['picture' => $picture]);
        }
        return view('saved-photos', ['pictures'=> $resultPictures, 'userId' => $request->id]);
    }

    public function share(Request $request){
        $picture = Picture::where('id', $request->id)->first();
        if(!UserSavePicture::where('picture_ID', $picture->id)->where('user_ID',Auth::user()->id)->exists()){
            $new = new UserSavePicture();
            $new->user_ID = Auth::user()->id;
            $new->picture_ID = $picture->id;
            $new->save();
            $picture->share_number += 1;
            $picture->save();

            $notification = new Notification();
            $notification->user_ID = Auth::user()->id;
            $notification->picture_ID = $picture->id;
            $notification->visited = 0;
            $notification->comment_ID = 1;
            $notification->type = 1; //share
            $notification->save();
        }
        else{
            $picture->share_number -= 1;
            $picture->save();
            Notification::where('user_ID',Auth::user()->id)->where('picture_ID', $picture->id)->delete();
            UserSavePicture::where('picture_ID', $picture->id)->where('user_ID',Auth::user()->id)->delete();
        }
        return response()->json(['success' => true]);
    }

    public function notification(Request $request){
        $notifications = Notification::orderBy('id', 'DESC')->get();
        $resultNotification = array();
        foreach ($notifications as $notification) {
            $picture = Picture::where('id', $notification->picture_ID)->first();
            if($picture->user_ID == Auth::user()->id && $picture->user_ID != $notification->user_ID){
                $user = User::where('id', $notification->user_ID)->first();
                array_push($resultNotification,['picture'=> $picture, 'user' => $user, 'notification' => $notification]);
            }
        }
        return view('notifications', ['notifications' => $resultNotification, 'userId' => Auth::user()->id]);
    }

    public function like(Request $request){
        $picture = Picture::where('id', $request->id)->first();
        if(!UserLikePicture::where('picture_ID', $picture->id)->where('user_ID',Auth::user()->id)->exists()){
            $new = new UserLikePicture();
            $new->user_ID = Auth::user()->id;
            $new->picture_ID = $picture->id;
            $new->save();
            $picture->react_number += 1;
            $picture->save();

            $notification = new Notification();
            $notification->user_ID = Auth::user()->id;
            $notification->picture_ID = $picture->id;
            $notification->visited = 0;
            $notification->comment_ID = 1;
            $notification->type = 2; //like
            $notification->save();
        }
        else{
            $picture->react_number -= 1;
            $picture->save();
            Notification::where('user_ID',Auth::user()->id)->where('picture_ID', $picture->id)->delete();
            UserLikePicture::where('picture_ID', $picture->id)->where('user_ID',Auth::user()->id)->delete();
        }
        return response()->json(['success' => true]);
    }
}
