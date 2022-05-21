<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AttachPostRequest;
use App\Models\Post;
use App\Models\Person ;

class PersonController extends Controller
{
    
    /**
     * Attach a post of the logged person
     * 
     * @param \App\Http\Requests\AttachPostRequest
     * @return \Illuminate\Http\Response
     **/
    public function attachPost(AttachPostRequest $request)
    {
        $input = $request->only('post_content') ;
        $person = Person::findOrFail( Auth::user()->id );
        $post = new Post;
        $post->post_content = $input['post_content'] ;
        $person->posts()->save($post);

        return response()->success("Successfully attached the post.");
           
    }

    /**
     * Get feeds of the logged person
     * 
     * @param 
     * @return \Illuminate\Http\Response
     **/
    public function getFeeds(){
        $person = Person::findOrFail(Auth::user()->id) ;
        $posts = $person->posts()->get();
        return response()->success("Retrived feeds successfully.", $posts);
    }
}
