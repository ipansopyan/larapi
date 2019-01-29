<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tutorial;


class TutorialController extends Controller
{
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
}
