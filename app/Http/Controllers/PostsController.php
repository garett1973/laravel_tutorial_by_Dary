<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $posts = DB::select('select * from posts where id = :id', ['id' => 1]);
//        $posts = DB::insert('insert into posts (title, excerpt, body, image, is_published, minutes_to_read) values (?, ?, ?, ?, ?, ?)', ['PHP with Laravel', 'Excerpt', 'Laravel is the best thing that has happened to PHP', 'Image Path', false, 5]);
//        $posts = DB::update('update posts set excerpt = ? where id = ?', ['This is updated excerpt', 203]);
//        $posts = DB::delete('delete from posts where id = ?', [203]);

        $posts = DB::table('posts')
//            ->select('title') // select only title
//                ->where('id', 1)
//                ->where('id', '>', 50)
//                ->where('is_published', true)
                ->select('title', 'minutes_to_read')
                ->where([
                    ['id', '>', 50],
                    ['is_published', true]
                ])
            ->whereBetween('minutes_to_read', [5, 10])
            ->whereNotBetween('minutes_to_read', [7, 8])
            ->whereIn('minutes_to_read', [5, 6, 9])
//            ->whereNull('excerpt')
                ->orderBy('minutes_to_read', 'desc')
//            ->inRandomOrder()
            ->skip(5)
            ->take(15)
            ->get();

        $posts2 = DB::table('posts')
            ->first();

        $posts3 = DB::table('posts')
            ->find(134);

        $posts4 = DB::table('posts')
            ->where('id', 134)
            ->value('title');

        $posts5 = DB::table('posts')
            ->where('id', 120)
            ->pluck('title');

        $posts6 = DB::table('posts')
            ->count();

        $posts7 = DB::table('posts')
            ->max('minutes_to_read');

        $posts8 = DB::table('posts')
            ->sum('minutes_to_read');

        $posts9 = DB::table('posts')
            ->avg('minutes_to_read');

//        dd($posts);
//        dd($posts2);
//        dd($posts3);
//        dd($posts4);
//        dd($posts5);
//        dd($posts6);
//        dd($posts7);
//        dd($posts8);
        dd($posts9);

        return view('blog.index');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id = 1) // with default value
    public function show($id) // without default value
    {
        return $id;
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
