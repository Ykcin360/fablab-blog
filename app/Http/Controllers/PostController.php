<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('post.index');
    }

    public function posts(): View
    {
        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Récupère tous les postes de l'utilisateur connecté en utilisant son ID avec pagination
        $posts = Post::where('user_id', $user->id)->where('state_id', '1')->latest()->paginate(4);

        return view('post.my-posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('post.create', ['categories' => $categories]);
    }

    public function search(Request $request): View
    {
        $q = $request->q;
        return view('post.search', ['q' => $q]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        if ($request->image != null) {
            $imageName = $request->file('image')->store('posts');
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imageName
            ]);
        } else {
            Post::create([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        return redirect()->route('post.index');
        // return redirect()->route('my-posts')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post): View
    {
        $comments = Comment::where('post_id', $post->id)->latest()->paginate(5);
        return view('post.show', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post): View
    {
        if (Auth::user()->is_admin==false && Gate::denies('update-post', $post)) {
            abort(403);
        }

        $categories = Category::all();
        return view('post.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post): RedirectResponse
    {
        $arrayUpdate = [
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category
        ];

        if ($request->image != null) {
            $imageName = $request->image->store('posts');
            $arrayUpdate = array_merge($arrayUpdate, [
                'image' => $imageName
            ]);
        }

        $post->update($arrayUpdate);

        return redirect()->route('post.index');
        // return redirect()->route('my-posts')->with('success', 'Post updated successfully');
    }

    public function delete(Request $request, Post $post): RedirectResponse
    {
        $post->state_id = 2;
        $post->category_id = $request->input('category');
        $post->save();

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post): RedirectResponse
    {
        if (Gate::denies('destroy-post', $post)) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('post.index');
        // return redirect()->route('my-posts')->with('success', 'Post deleted successfully');
    }
}