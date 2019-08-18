<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function homepage(){
        return view('homepage');
    }
    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move("image", $imageName);
        $request->image = $imageName;

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $imageName;
        $post->save($request->all());
        return $post;
        //return Post::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Post::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return Post::findOrFail($id);
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
        //
        $posts = Post::findOrFail($id);

        
        if($request -> hasFile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            if(file_exists("Image/".$posts->image)){
                    unlink("Image/".$posts->image);
            }
            $request->image->move("image", $imageName);
            $request->image = $imageName;

            $posts->image = $imageName;
        }
        $posts->title = $request->title;
        $posts->description = $request->description;
        
        $posts->save();
       // $posts->update($request->all());
        return $posts;
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
        $posts = Post::findOrFail($id);
        if(file_exists("Image/".$posts->image)){
                unlink("Image/".$posts->image);
        }
        $posts->delete();
        return $posts;
    }
}
