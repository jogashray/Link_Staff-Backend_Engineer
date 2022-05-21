<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\PageRequest ;
use App\Http\Requests\AttachPostRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Post;


class PageController extends Controller
{
    /**
     * Create a page 
     * 
     * @param App\Http\Requests\PageRequest ;
     * @return \Illuminate\Http\Response
     **/
    public function create(PageRequest $request)
    {

        $input = $request->safe()->only(['page_name']);
        $input['person_id'] = Auth::user()->id ;
        $page = Page::create($input);

        return response()->success("Page has been created successfully");  
    }

    /**
     * Attach a post to the page 
     * 
     * @param \App\Http\Requests\AttachPostRequest, int $id 
     * @return \Illuminate\Http\Response
     **/
    public function attachPost(AttachPostRequest $request, $id)
    {

        $input = $request->safe()->only('post_content') ;
        $page = Page::findOrFail($id);
        $post = new Post;
        $post->post_content = $input['post_content'] ;
        $page->posts()->save($post);

        return response()->success("Successfully attached the post");   
    }
}
