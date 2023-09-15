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