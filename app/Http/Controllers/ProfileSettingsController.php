<?php

namespace App\Http\Controllers;

use App\models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($username)
    {
        if (Auth::user()->username == $username) {
            $user = User::where('username', Auth::user()->username)
                ->with('settings')
                ->firstOrFail();
        } else {
            abort(404);
        }
        // dd($user);
        return view('profile.settings', compact('user'));
    }

    public function saveSetting(Request $request,)
    {
        $settings = Settings::find(Auth::user()->id);

        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'bio' => 'required|max:200',
        ]);

        if ($request->hasFile('thumbnail')) {
            $filename = time() . '.' . $request->thumbnail->extension();
            $path = 'uploads/profile_pictures/' . Auth::user()->username;
            $request->thumbnail->move(public_path($path), $filename);
            $profilePicture = Auth::user()->username . '/' . $filename;
            $settings->profile_pic = $profilePicture;
        } else {
            $defaultImagePath = 'uploads/profile_pictures/default';
            $defaultImage = $defaultImagePath . '/' . 'user_icon2.jpg';
            $data['profile_pic'] = $defaultImage;
        }

        $settings->bio = $request->bio;
        $settings->save();

        if (!$settings) {
            Session::flash('message', 'Error while Updating users details !');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        Session::flash('message', 'Details has been updated successfully !');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('profile.settings', Auth::user()->username);
    }

    /**
     * Change the current password
     * @param Request $request
     * @return Renderable
     */
    public function changePassword(Request $request)
    {
        // $user = Auth::user();
        // dd($user);
        // $user = new User();
        $user = User::findorfail(Auth::user()->id);


        $userPassword = $user->password;

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);

        if (Hash::check($request->current_password, $userPassword)) {

            $user->fill([
               'password' => Hash::make($request->password),
            ])->save();

            Session::flash('message', 'password successfully updated !');
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        }


        return back()->withErrors([
            'current_password' => 'Your current password is incorrect',
        ]);

    }
}