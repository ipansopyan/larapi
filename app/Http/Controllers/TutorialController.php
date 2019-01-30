<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tutorial;


class TutorialController extends Controller
{
    public function index(){
        return Tutorial::all();
    }

    public function show($id){
        $tutorial = Tutorial::with('comments')->where('id', $id)->get();
        if(!$tutorial){
            return response()->json([
                'error' => 'id not found'
            ], 404);
        }

        return $tutorial;
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'     => 'required',
            'body'      => 'required',
        ]);

        $tutorial = $request->user()->tutorials()->create([
            'title'     => $request->json('title'), 
            'slug'      => str_slug($request->json('title')),
            'body'      => $request->json('body')
        ]);

        return $tutorial;
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'title'     => 'required',
            'body'      => 'required',
        ]);
        
        $tutorial = Tutorial::find($id);
        if(!$tutorial){
            return response()->json([
                'error' => 'id not found'
            ], 404);
        };
        if($request->user()->id != $tutorial->user_id){
            return response()->json([
                'error' => 'tidak boleh mengubah ini'
            ]);
        };

        $tutorial->title    = $request->title;
        $tutorial->body	    = $request->body;
        $tutorial->save();
        return $tutorial; 
    }
    
    public function destroy(Request $request ,$id){
        $tutorial = Tutorial::find($id);
        if(!$tutorial){
            return response()->json([
                'error' => 'id not found'
            ], 404);
        };
        if($request->user()->id != $tutorial->user_id){
            return response()->json([
                'error' => 'cannot delete this post'
            ]);
        };

        $tutorial->delete();

        return response([
            'success'   => true,
            'message'   => 'has ben deleted'
        ]);
    }   
}
