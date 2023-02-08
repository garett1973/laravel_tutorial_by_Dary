<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Example of using DB facade
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
//     */
//    public function index()
//    {
//
////        $posts = DB::select('select * from posts where id = :id', ['id' => 1]);
////        $posts = DB::insert('insert into posts (title, excerpt, body, image, is_published, minutes_to_read) values (?, ?, ?, ?, ?, ?)', ['PHP with Laravel', 'Excerpt', 'Laravel is the best thing that has happened to PHP', 'Image Path', false, 5]);
////        $posts = DB::update('update posts set excerpt = ? where id = ?', ['This is updated excerpt', 203]);
////        $posts = DB::delete('delete from posts where id = ?', [203]);
//
//        $posts = DB::table('posts')
////            ->select('title') // select only title
////                ->where('id', 1)
////                ->where('id', '>', 50)
////                ->where('is_published', true)
//                ->select('title', 'minutes_to_read')
//                ->where([
//                    ['id', '>', 50],
//                    ['is_published', true]
//                ])
//            ->whereBetween('minutes_to_read', [5, 10])
//            ->whereNotBetween('minutes_to_read', [7, 8])
//            ->whereIn('minutes_to_read', [5, 6, 9])
////            ->whereNull('excerpt')
//                ->orderBy('minutes_to_read', 'desc')
////            ->inRandomOrder()
//            ->skip(5)
//            ->take(15)
//            ->get();
//
//        $posts2 = DB::table('posts')
//            ->first();
//
//        $posts3 = DB::table('posts')
//            ->find(134);
//
//        $posts4 = DB::table('posts')
//            ->where('id', 134)
//            ->value('title');
//
//        $posts5 = DB::table('posts')
//            ->where('id', 120)
//            ->pluck('title');
//
//        $posts6 = DB::table('posts')
//            ->count();
//
//        $posts7 = DB::table('posts')
//            ->max('minutes_to_read');
//
//        $posts8 = DB::table('posts')
//            ->sum('minutes_to_read');
//
//        $posts9 = DB::table('posts')
//            ->avg('minutes_to_read');
//        $posts10 = DB::table('posts')->find(3);
//
////        dd($posts);
////        dd($posts2);
////        dd($posts3);
////        dd($posts4);
////        dd($posts5);
////        dd($posts6);
////        dd($posts7);
////        dd($posts8);
////        dd($posts9);
//
////        return view('blog.index')->with('posts', $posts10); //one way
////        return view('blog.index', ['posts' => $posts10]); //another way
//        return view('blog.index', [
//            'posts' => $posts,
//            'id' => $posts10->id,
//            'title' => $posts10->title
//        ]); //probably the most used way
//    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index() {
//        $posts = Post::all(); // same as get(), just can't use method chaining
        $posts = Post::orderBy('updated_at', 'desc')->paginate(15); // same as all(), but you can use method chaining, get goes at the end

//        $posts = Post::orderBy('id', 'desc')->take(10)->get();
//        $posts = Post::where('id', '>', 150)->get();
//        $posts = Post::where('minutes_to_read', '<', 3)->orderBy('id', 'desc')->take(50)->get();

//        Post::chunk(25, function($posts) {
//            foreach ($posts as $post) {
//                echo $post->title . '<br>';
//            }
//        }); // chunk is used for pagination

//        $postsCount = Post::count();
//        $postsSum = Post::sum('minutes_to_read');
//        $postsAvg = Post::avg('minutes_to_read');
//        $postsByUpdatedAt = Post::orderBy('updated_at', 'desc')->get();

//        dd($postsCount);
//        dd($postsSum);
//        dd($postsAvg);


        return view('blog.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PostFormRequest $request)
    {
        // Validation
//        $request->validate([
//            'title' => 'required|unique:posts|max:255',
//            'excerpt' => 'required|string',
//            'body' => 'required',
//            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
//            'minutes_to_read' => 'numeric|min:1|max:60',
//        ]);

        // Validation is performed in PostFormRequest
        $request->validated();

        // OOP way
//        $post = new Post();
//        $post->title = $request->title;
//        $post->excerpt = $request->excerpt;
//        $post->body = $request->body;
//        $post->image = 'https://via.placeholder.com/150';
//        $post->is_published = $request->is_published === 'on';
//        $post->minutes_to_read = $request->minutes_to_read;
//        $post->save();

        // Eloquent way
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image' => $this->storeImage($request),
            'is_published' => $request->is_published === 'on' ? 1 : 0,
            'minutes_to_read' => $request->minutes_to_read,
        ]);

        $post->meta()->create([
            'post_id' => $post->id,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'meta_robots' => $request->meta_robots,
        ]);

        return redirect(route('blog.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
//    public function show($id = 1) // with default value
    public function show($id) // without default value
    {
        $post = Post::findOrFail($id); // if not found, throws 404 error
        return view('blog.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('blog.edit', [
            'post' => Post::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PostFormRequest $request, $id)
    {
        // Validation
//        $request->validate([
//            'title' => 'required|max:255|unique:posts,title,' . $id,
//            'excerpt' => 'required',
//            'body' => 'required',
//            'image' => 'mimes:jpg,jpeg,png|max:2048',
//            'minutes_to_read' => 'numeric|min:1|max:60',
//        ]);
        $request->validated();
        $request->merge([
            'is_published' => $request->is_published === 'on' ? 1 : 0,
        ]);

        Post::findOrFail($id)->update($request->except(['_token', '_method']));
//        Post::where('id', $id)->update($request->except(['_token', '_method']));

        return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect(route('blog.index'))->with('message', 'Post deleted successfully!');
    }

    private function storeImage($request)
    {
        $newImageName = uniqid('', true) . '-' . $request->title . '.' . $request->image->extension();

        return $request->image->move(public_path('images'), $newImageName);
    }
}
