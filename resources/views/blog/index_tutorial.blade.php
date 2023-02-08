<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<body>
{{--    <h1 class="text-amber-300xl">--}}
{{--        Index of blog posts--}}
{{--    </h1>--}}

{{--    {{ $name = 'Virgis' }}--}}

{{--    <a href={{ route('blog.index') }}>Blog</a>--}}
{{--    <a href={{ route('blog.show', ['id' => 1]) }}>Get single blog</a>--}}
    {{--<a href={{ route('blog.show', ['name' => 'Virgis']) }}>Blog by name</a>--}}
<div class="text-bg-danger">
    <h2 style="color: #0c63e4">
        {{ $id }} => {{ $title }}
    </h2>
</div>

@if ($id === 1)
    <p>First blog post</p>
@elseif($id === 2)
    <p>Second blog post</p>
@else
    <p>Some other blog post</p>
@endif

@unless ($id === 1)
    <p>First blog post</p>
@else
    <p>Some other blog post</p>
@endunless

@isset($id)
    <p>Id is set</p>
@endisset

@empty($id)
    <p>Id is empty</p>
@endempty

@switch($id)
    @case(1)
        <p>First blog post</p>
        @break
    @case(2)
        <p>Second blog post</p>
        @break
    @default
        <p>Some other blog post</p>
@endswitch

@for($i = 0; $i < 10; $i++)
    <p>{{ $i }}</p>
@endfor

@foreach($posts as $post)
    loop depth: {{ $loop->depth }}
    <p>{{ $post->title }}</p>
@endforeach

@forelse($posts as $post)
    <p>Minutes to read: {{ $post->minutes_to_read }}</p>
@empty
    <p>No posts</p>
@endforelse

@forelse($posts as $post)
    {{ $loop->index }} => {{ $post->title }} <br>
@empty
    <p>No posts</p>
@endforelse

@forelse($posts as $post)
    {{ $loop->iteration }} => {{ $post->title }} <br>
@empty
    <p>No posts</p>
@endforelse


</body>
</html>
