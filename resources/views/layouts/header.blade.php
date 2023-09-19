@php
$sourceArray = json_decode(file_get_contents(public_path('data.json')),true)['source'];
@endphp
<div class="header">
    <div class="logo"><a href="/homepage">
            <h1>VNNEWS</h1>
        </a></div>
    <div class="search">
        <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
            </svg>
        </div>
        <input id="input" type="text" placeholder="Search">
        <div class="output">

        </div>
    </div>
    <div class="account">
        <div class="login"><a href="/login">
                <h3>Login</h3>
            </a></div>
        <div class="signup"><a href="/signup">
                <h3>Sign up</h3>
            </a></div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if (localStorage.getItem('token') != undefined) {
            let user = getUser();
            console.log(getUser());
        }
    });

    function getUser() {
        $.ajax({
            url: '/api/getUser',
            type: 'post',
            data: {

            },
            headers: {
                'Authorization': localStorage.getItem('token')
            },
            success: function(response) {
                if (response.user != null) {
                    html = '<div class="username"><a href="#"><h3>' + response.user.name + '</h3></a></div><div class="logout"><a href="#"><h3>Log out</h3></a></div>';
                    $('.account').html(html);
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    const inputElement = document.getElementById("input");
    let timeoutId;
    const delay = 1000;

    inputElement.addEventListener("input", function() {
        clearTimeout(timeoutId);

        const inputValue = inputElement.value;
        if (inputValue == '') {
            $('.output').css('display', 'none');
        } else {
            timeoutId = setTimeout(function() {
                $.ajax({
                    url: '/api/search/' + inputValue,
                    type: 'get',
                    success: function(response) {
                        const search_news = response.search_news;
                        const regex = new RegExp(inputValue, "gi");
                        const sourceArray = @json($sourceArray);
                        let html = '';
                        for (let i = 0; i < search_news.length; i++) {
                            const news = search_news[i];
                            const title = news['title'].replace(regex, match => {
                                return '<b>' + match + '</b>';
                            });
                            html += '<div class="frame"><div class = "source" ><p><a href = "' +
                                news['link'] + '">' + sourceArray[news['source']] +
                                '</a></p></div><div class = "title" ><a href = "#" data-toggle = "modal" data-target = "#postModal" data-id = "' +
                                news['id'] + '">' + title + '</a><div class="tags">';
                            for (let j = 0; j < news['tag_names'].length; j++) {
                                const tag = news['tag_names'][j];
                                html += '<div class="tag">' + tag + '</div>';
                            }
                            html += '</div> </div> </div>';
                        }
                        $('.output').html(html);
                        $('.output').css('display', 'block');
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }, delay);
        }
    });

    inputElement.addEventListener("keydown", function(event) {
        if (event.key === "Enter" || event.keyCode === 13) {
            const inputValue = inputElement.value;
            window.location.href = '/search/' + inputValue;
        }
    });
</script>
