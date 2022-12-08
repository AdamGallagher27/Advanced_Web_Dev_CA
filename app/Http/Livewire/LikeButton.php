<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Like;

class LikeButton extends Component
{
    

    public $movie;
    public $currentUser;

    // checks if the user has liked the movie already
    private function hasLiked( $movie_id, $user_id ) {
        $likes = Like::where("movie_id", $movie_id)->get();

        foreach ($likes as $like) {
            if($like->movie_id == $movie_id and $like->user_id == $user_id) {
                return true;
            }
        } 

        return false;
    }

    // function for liking a movie
    // this is called when the like button is pressed on show view
    public function likeDislike( $movie_id, $user_id )
    {

        // if the user hasnt liked this movie before
        if(self::hasLiked($movie_id, $user_id)) {
            // remove like from db
            DB::table('likes')->where('movie_id', $movie_id)->where('user_id', $user_id)->delete();
            
        }
        else {
            // add new like to the like table
            $like = new Like;
            $like->movie_id = $movie_id;
            $like->user_id = $user_id;
            $like->save(); 
        }


    }


    // renders component to the screen
    public function render()
    {
        return view('livewire.like-button');
    }
}
