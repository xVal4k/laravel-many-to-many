<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use \App\Traits\searchFilters;

    private function confValidation($arg)
    {
        return [
            'title' => 'required|max:100',
            'content' => 'required',
            'image' => 'required|max:1000',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($arg),
                'max:100'
            ],
            'category_id'  => 'required|exists:App\Category,id',
            'tags'          => 'exists:App\Tag,id'
        ];
    }


    public function userIndex()
    {
        $posts = Post::where('user_id', Auth::user()->id)->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->composeQuery($request);

        $posts = $posts->paginate(20);

        $queries = $request->query();
        unset($queries['page']);
        $posts->withPath('?' . http_build_query($queries, '', '&'));

        $categories = Category::all();
        $users = User::all();

        return view('admin.posts.index', [
            'posts'         => $posts,
            'categories'    => $categories,
            'users'         => $users,
            'request'       => $request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->confValidation(null));

        $data = $request->all() + [
            'user_id' => Auth::user()->id
        ];

        preg_match_all('/#(\S*)\b/', $data['content'], $tags_from_content);

        $tagIds = [];
        foreach ($tags_from_content[1] as $tag) {
            $newTag = Tag::create([
                'name'  => $tag,
                'slug'  => $tag
            ]);

            $tagIds[] = $newTag->id;
        }

        $data['tags'] = $tagIds;

        $post = Post::create($data);
        $post->tags()->attach($data['tags']);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $categories = \App\Category::all();
        $tags = \App\Tag::all();

        return view('admin.posts.edit', [
            'post'          => $post,
            'categories'    => $categories,
            'tags'          => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);


        $request->validate($this->confValidation($post));
        $data = $request->all();

        $post->update($data);
        $post->tags()->sync($data['tags']);


        $post->update($request->all());

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->tags()->sync([]);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', "Post $post->title deleted");
    }
}
