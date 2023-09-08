<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    @php
        $sourceArray = json_decode(file_get_contents(public_path('data.json')),true)['source'];
    @endphp
    @include('layouts.header')
    <div class="content">
        <div class="left">
            <div class="latest-news">
                <h2>Tin mới nhất</h2>
                <div class="back-page">
                    <div id="back-page"><a href="/homepage/prev/{{$page}}"> <svg  xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 256 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 278.6c-12.5-12.5-12.5-32.8 0-45.3l128-128c9.2-9.2 22.9-11.9 34.9-6.9s19.8 16.6 19.8 29.6l0 256c0 12.9-7.8 24.6-19.8 29.6s-25.7 2.2-34.9-6.9l-128-128z"/></svg></a></div>
                </div>
                <div class="fr">
                    @foreach ($latest_news as $post)
                        <div class="frame">
                            <div class="source"><p><a href="{{$post['link']}}">{{ $sourceArray[$post['source']] }}</a></p></div>
                            <div class="title">
                                {{ $post['title'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="next-page">
                    <div id="next-page"><a href="/homepage/next/{{$page}}"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 256 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"/></svg></a></div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="hot-news">
                <h2>Tin hot</h2>
                @foreach ($hot_news as $post)
                    <div class="frame">
                        <div class="source"><p><a href="{{$post['link']}}">{{ $sourceArray[$post['source']] }}</a></p></div>
                        <div class="title">
                            {{ $post['title'] }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="recent-news">abc</div>
        </div>
    </div>
</body>
</html>
