<?php

// controller pour la gestion des articles (permet de définir les actions
//pour afficher tous les commentaires, afficher 1 commentaires, ajouter ou delete un article
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('articles.index')->with(compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->lists('name', 'id');
        return view('articles.create')->with(compact('users'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->user_id  = Auth::user()->id;
        $post->title    = $request->title;
        $post->content  = $request->content;
        $post->save();
        return redirect()
            ->route('articles.show', $post->id)
            ->with(compact('post'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id','=',$id)->get()->first();
        $comments = $post->comments;
        return view('articles.show')->with(compact('post','comments'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post   = Post::find($id);
        $users  = User::all()->lists('name', 'id')  ;
        return view('articles.edit')->with(compact('post', 'users'));
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
        $post = Post::find($id);
        $post->title   = $request->title;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('articles.show', $post->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('articles.index');
    }
}