<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Tutorial;

class CommentController extends Controller
{
    public function store(Request $request,$id){
        $this->validate($request, [
            'body'  => 'required'
        ]);

        $comment = $request->user()->comments()->create([
            'body'          => $request->json('body'),
            'tutorial_id'   => $request->id
        ]);

        return $comment;
    }

}
