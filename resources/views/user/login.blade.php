<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="form-login">

        <div class="form">
            <!-- <div class="imgcontainer">
                <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div> -->

            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button id="login">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </div>
    </div>

</body>
<script>
    $(document).ready(function() {
        $('body').on('click', '#login', function(e) {
            login();
        });
    });
    function login(){
        $.ajax({
            url: '/api/login',
            type: 'post',
            data: {
                'email': document.querySelector("input[name='email']").value,
                'password':  document.querySelector("input[name='password']").value,
            },
            success: function(response) {
                if(response.email != undefined){
                    alert(response.email);
                }
                if(response.password != undefined){
                    alert(response.password);
                }
                if(response.token != undefined){
                    if(response.token == ''){
                        alert('Email or password is incorrect');
                    }
                    else{
                        localStorage.setItem('token',response.token);
                        window.location.href = '/';
                    }
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>
</html>
