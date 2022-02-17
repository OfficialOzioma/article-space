<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\User;


class Follow extends Component
{
    public $name;
    public bool $following = false;
    public $userToBefollowed;
    public $loggedInUser;
    public $user;
    public $authicated_User;
    public $articlesCount;


    public function mount($username)
    {
        $this->authicated_User = Auth::user()->username == $username;


        $getUserToBefollowed = User::where('username', $username)->first();

        if (!empty($getUserToBefollowed)) {

            $this->user = $getUserToBefollowed;

            $this->articlesCount = Article::where('user_id', $getUserToBefollowed->id)->count();

            $this->userToBefollowed = User::find($getUserToBefollowed->id); //the user to being followed
            $this->loggedInUser = User::find(auth()->user()->id); //the logged in user

            $this->following = $this->loggedInUser->isFollowing($this->userToBefollowed);
        }
    }

    public function render()
    {
        $this->user = User::where('username', Auth::user()->username)->first();
        return view('livewire.follow');
    }

    public function follow()
    {

        if ($this->following) {
            $this->loggedInUser->unfollow($this->userToBefollowed);
        } else {
            $this->loggedInUser->follow($this->userToBefollowed);
        }

        $this->following = !$this->following;
    }
}