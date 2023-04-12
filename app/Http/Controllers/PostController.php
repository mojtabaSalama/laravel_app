<?php

namespace App\Http\Controllers;
use Collective\Html\FormFacade as Form;
use Illuminate\Http\Request;
use App\Models\posts;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts= posts::orderby('created_at','desc')->get();
       
        
       
        
        return view('posts.index')->with( "posts" , $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
$this->validate($request,[


'image'=>'image|required_without : body|max:1999'

]);
//file uploade
if($request->hasFile('image')){
$filenamewithext=$request->file('image')->getClientOriginalName();
$filename= pathinfo($filenamewithext,PATHINFO_FILENAME);
$extention=$request->file('image')->getClientOriginalExtension();
$filenametostore=$filename.'_'.time().'.'.$extention;
$path=$request->file('image')->storeAs('public/image',$filenametostore);
}
else
{


$filenametostore=null;

}



$post=new posts;
$post->body = $request->input('body');
$post->user_id=auth()->user()->id;
$post->image=$filenametostore;
$post->save();


return redirect('/')->with('success','post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $post =posts::find($id);
    
     return view('posts.show')->with('post',$post);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =posts::find($id);
        if (auth()->user()->id!= $post->user->id) {
            return redirect('/')->with('error','unauthrized page');
        }
    
        return view('posts.edit')->with('post',$post);
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

            'body'=>'required',
           'image'=>'image|nullable|max:1999' 
            
            ]);


            if($request->hasFile('image')){
                $filenamewithext=$request->file('image')->getClientOriginalName();
                $filename= pathinfo($filenamewithext,PATHINFO_FILENAME);
                $extention=$request->file('image')->getClientOriginalExtension();
                $filenametostore=$filename.'_'.time().'.'.$extention;
                $path=$request->file('image')->storeAs('public/image',$filenametostore);
                }
               
                
            $post= posts::find($id);
            $post->body = $request->input('body');
            if ($request->hasFile('image')) {
                $post->image=$filenametostore;
            }
            $post->save();
            
            
            return redirect('/')->with('success','post edited');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=posts::find($id);
        if (auth()->user()->id!= $post->user_id) {
            return redirect('/posts/{id}')->with('error','unauthrized page');
        }

        if($post->image!=null){

            Storage::delete('public/image/'.$post->image);

        }
    
        $post->delete();
        return redirect('/')->with('success','post removed');
    }

    public function likePost($id)
    {
        $post = Posts::find($id);
        if($post->liked()){

            $post->unlike();
            $post->save();


        }
        else {
        
        $post->like();
        $post->save();
        }
        return redirect()->back();
    }

    
}
?>