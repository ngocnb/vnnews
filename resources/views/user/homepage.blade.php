<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    @include('layouts.header')
    <div class="content">
        <div class="left">
            <div class="latest-news">
                <h2>Tin mới nhất</h2>
                <div class="back-page">
                    <div id="back-page"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 256 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d="M9.4 278.6c-12.5-12.5-12.5-32.8 0-45.3l128-128c9.2-9.2 22.9-11.9 34.9-6.9s19.8 16.6 19.8 29.6l0 256c0 12.9-7.8 24.6-19.8 29.6s-25.7 2.2-34.9-6.9l-128-128z" />
                        </svg></div>
                </div>
                <div class="fr">

                </div>
                <div class="next-page">
                    <div id="next-page"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 256 512">
                            <path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z" />
                        </svg></div>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="hot-news">
                <h2>Tin hot</h2>

            </div>
            <div class="read-news">

            </div>
        </div>
    </div>

    <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

</body>

<script>
    $(document).ready(function() {
        localStorage.setItem('page', 1);
        $('body').on('click', '.title a', function(e) {
            e.preventDefault();
            let postId = $(this).data('id');
            localStorage.setItem('reading', JSON.stringify(postId));
            getPostDetails(postId);
        });
        $('body').on('click', '#back-page', function(e) {
            let page = localStorage.getItem('page') || 1;
            page--;
            if (page == 0) page = localStorage.getItem('total_pages');
            localStorage.setItem('page', page);
            loadData();
        });
        $('body').on('click', '#next-page', function(e) {
            let page = localStorage.getItem('page') || 1;
            page++;
            if (page > localStorage.getItem('total_pages')) page = 1;
            localStorage.setItem('page', page);
            loadData();
        });
        loadData();
    });

    function getPostDetails(postId) {
        $.ajax({
            url: '/api/getNewsById/' + postId,
            type: 'get',
            success: function(response) {
                let postData = response.news;
                $('.modal-title').html(postData['title']);
                let postDetailsHtml = postData['content'];
                let tags = '<div class="tags">';
                for (let index = 0; index < postData['tag_names'].length; index++) {
                    const tag = postData['tag_names'][index];
                    tags += '<div class="tag">' + tag + '</div>';
                }
                tags += '</div>';
                postDetailsHtml += tags;
                postDetailsHtml += '<div class="button"><a href="/login"><svg class="like" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z"/></svg></a>';
                postDetailsHtml += '<a href="/login"><svg class="dislike" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M313.4 479.1c26-5.2 42.9-30.5 37.7-56.5l-2.3-11.4c-5.3-26.7-15.1-52.1-28.8-75.2H464c26.5 0 48-21.5 48-48c0-18.5-10.5-34.6-25.9-42.6C497 236.6 504 223.1 504 208c0-23.4-16.8-42.9-38.9-47.1c4.4-7.3 6.9-15.8 6.9-24.9c0-21.3-13.9-39.4-33.1-45.6c.7-3.3 1.1-6.8 1.1-10.4c0-26.5-21.5-48-48-48H294.5c-19 0-37.5 5.6-53.3 16.1L202.7 73.8C176 91.6 160 121.6 160 153.7V192v48 24.9c0 29.2 13.3 56.7 36 75l7.4 5.9c26.5 21.2 44.6 51 51.2 84.2l2.3 11.4c5.2 26 30.5 42.9 56.5 37.7zM32 384H96c17.7 0 32-14.3 32-32V128c0-17.7-14.3-32-32-32H32C14.3 96 0 110.3 0 128V352c0 17.7 14.3 32 32 32z"/></svg></a></div>';
                $('.modal-body').html(postDetailsHtml);
                $('#postModal').modal('show');
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    $('.modal').scroll(function() {
        let modal = $('.modal');
        let scrollPosition = modal.scrollTop();
        let modalHeight = modal.innerHeight();
        let contentHeight = modal[0].scrollHeight;
        if (scrollPosition + modalHeight >= contentHeight) {
            let postId = JSON.parse(localStorage.getItem('reading'));
            let readNews = JSON.parse(localStorage.getItem('readNews')) || [];
            let exist = false;
            for (let i = 0; i < readNews.length; i++) {
                if (readNews[i] == postId) exist = true;
            }
            if (!exist) {
                readNews.push(postId);
                localStorage.setItem('readNews', JSON.stringify(readNews));
            }
        }
    });

    function loadData() {
        $.ajax({
            url: '/api/loadData',
            type: 'post',
            data: {
                'page': localStorage.getItem('page') || 1,
            },
            success: function(response) {
                $('.fr').html(response.latest_news);
                $('.hot-news').html(response.hot_news);
                localStorage.setItem('total_pages', response.total_pages);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>

</html>