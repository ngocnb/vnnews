@php
$sourceArray = json_decode(file_get_contents(public_path('data.json')),true)['source'];
@endphp
@foreach ($news as $post)
<div class="frame">
    <div class="source">
        <p><a href="{{$post['link']}}">{{ $sourceArray[$post['source']] }}</a></p>
    </div>
    <div class="title">
        <a href="#" data-toggle="modal" data-target="#postModal" data-id="{{ $post['id'] }}">
            {{ $post['title'] }}
        </a>
        <div class="tags">
            @foreach($post->tag_names as $tag)
            <div class="tag">
                {{$tag}}
            </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach