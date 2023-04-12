<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posts;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{


    public function users()
    {
        $users = User::get();
        return view('profiles.users')-> with('users',$users);
    }
    public function show($id)
    {
        $user = User::find($id);
        $posts = $user->posts()->get();
        return view('profiles.profile')->with(array("user" => $user, "posts" => $posts));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =user::find($id);
        if (auth()->user()->id!= $user->id) {
            return redirect('/')->with('error','unauthrized page');
        }
    
        return view('profiles.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'name'=>'required',
            'profilepic'=>'image|nullable|max:1999'
            ]);


            if($request->hasFile('profilepic')){
                $filenamewithext=$request->file('profilepic')->getClientOriginalName();
                $filename= pathinfo($filenamewithext,PATHINFO_FILENAME);
                $extention=$request->file('profilepic')->getClientOriginalExtension();
                $filenametostore=$filename.'_'.time().'.'.$extention;
                $path=$request->file('profilepic')->storeAs('public/profilepic',$filenametostore);
                }
                else{
                    $filenametostore="noimage.jpg"  ;
                }
               
                
            $user=auth()->user() ;
            $user->name = $request->input('name');
            if ($request->hasFile('profilepic')) {
                $user->profilepic=$filenametostore;
            }
            $user->save();
            
            
            return redirect()->route('profile', ['id' => $user->id]);
            
    }
    public function follwUserRequest(Request $request){
 
 
        $user = User::find($request->id);
        $response = auth()->user()->toggleFollow($user);
 
 
        $posts = $user->posts()->get();
        return redirect()->back();
    }



    public function following($id)
    {
        $user = User::find($id);
        return view('profiles.following')->with("user" , $user);   
    }
    
    
    public function followers($id)
    {
        $user = User::find($id);
    
        return view('profiles.followers')->with("user" , $user);   
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
