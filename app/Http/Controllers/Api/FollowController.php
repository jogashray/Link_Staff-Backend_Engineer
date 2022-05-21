<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use App\Http\Requests\FollowPersonRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\Person;
use App\Models\Page;

class FollowController extends Controller
{
    /**
     * Follow to a Person.
     * 
     * @param \Illuminate\Http\Request $request, Person $person_id
     * @return \Illuminate\Http\Response; 
     */
    public function followPerson(Request $request, $person_id){
        $res = $this->checkExistsOrGet(new Person, $person_id) ;
        if( $res !== true){
            return $res ;  // Return response is already followed.
        }

        $person = Person::findOrFail($person_id);
        $follow = new Follow;
        $follow->follower_id = Auth::user()->id ;
        $person->follows()->save($follow);

        return response()->success("successfully followed."); 
    }

    /**
     * Follow to a page.
     * 
     * @param \Illuminate\Http\Request $request, Page id
     * @return \Illuminate\Http\Response; 
     */
    public function followPage(Request $request, $page_id){
        $res = $this->checkExistsOrGet(new Page, $page_id) ;
        if( $res !== true){
            return $res ; // Return response is already followed.
        }

        $page = Page::findOrFail($page_id);
        $follow = new Follow;
        $follow->follower_id = Auth::user()->id ;
        $page->follows()->save($follow);

        return response()->success("successfully followed.");  
    }

    /**
     * If the follower already exists, then return response, else return true
     * 
     * @param Page or Person $object, int $id
     * @return \Illuminate\Http\Response or bool
     */
    private function checkExistsOrGet($object, $id){

        //Check whether the following id exists, if exists, then return success response. 

        $following = Follow::where('follower_id', Auth::user()->id )
            ->where("followable_id", $id)
            ->where('followable_type', get_class($object))->first();

        if(isset($following->id)){
            // Return response is already followed.
            return response()->success("successfully already followed.");
        }

        return true;
    }

}
