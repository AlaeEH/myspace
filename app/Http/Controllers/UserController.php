<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Image;
use App\User;
use App\Like;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function profile(){
        $user = User::find();    
        return view('profile')->with('user', $user);
    }

    public function user($id){
        $user = User::with('Like')->where('id', $id)->first();
        $likes = Like::where('user_liked_id', $user->id)->get();
        return view('user')->with('user', $user)->with('likes', $likes);
    }
    
 
    public function show(Request $request)
    {
        $user = User::all()->except(Auth::id());
        return view('welcome', compact('user'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function edit($id)
    {
        // $user = User::find($id);
        // return view('profile', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        try {
            if($request->has('image')){

                $request->validate([
                    'image' => ['image','mimes:jpeg,png,jpg','max:2048'],
                ]);

                // Generate random Hash so there wont be any conficts in the database
                $hash = bin2hex(random_bytes(16));
                $fileName = 'storage\profile\default.png';
                $fileName = $hash . '.' . request()->image->getClientOriginalExtension();
                

                // Store File in the Storage    
                $image = Image::make($request->image)->resize(320, 320)->save(public_path('storage\profile\\'.$fileName), 100, request()->image->getClientOriginalExtension());
                $user->image = $fileName;

                // Delete image out of Storage
                if(Storage::has('storage\profile\\'. Auth::user()->image)){
                    Storage::delete('storage\profile\\'. Auth::user()->image);
                }

            }
            
            $request->validate([
                'username' => ['required', 'regex:/^[a-zA-Z ]+$/', 'string', 'max:191',
                    Rule::unique('users', 'username')->ignore(Auth::id()),
                ],
                'first_name' => ['required', 'regex:/^[a-zA-Z ]+$/', 'string', 'max:191'],
                'last_name' => ['required', 'regex:/^[a-zA-Z ]+$/', 'string', 'max:191'],
                'email' => ['required', 'string', 'email', 'max:191',
                    Rule::unique('users', 'email')->ignore(Auth::id()),
                ],
                'address' => ['required', 'string', 'max:191'],
                'zipcode' => ['required', 'string', 'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i', 'max:8'],
            ]);

            $user->username = $request->get('username');
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->email = $request->get('email');
            $user->address = $request->get('address');
            $user->zipcode = $request->get('zipcode');
            $user->relationship_status = $request->get('relationship_status');
            $user->save();

            return redirect('profile')->with('success', 'Your credentials have been updated succesfully.');
        }

        catch(Exception $e) {
            return redirect('profile')->with('error', 'Ohhhwwww gash darnit. Errors all the way :(');
        }
    }
}