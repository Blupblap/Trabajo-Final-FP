<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background-image: url("{{ asset('img/bg.jpg') }}");
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -2px black;
            }


            .m-b-md {
                margin-bottom: 30px;
            }

            #main{
                margin-top: 10%;
                color: white;
            }

            #logindiv{
                background-color: none;
                display: flex;
                margin: auto;
                justify-content: space-around;
            }

            #logindiv a{
                margin: 15px;
                background-color: white;
                color: black;
                padding: 8px;
                font-weight: bold;
                font-size: 1.3em;
                border-radius: 5px;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div id="main">
                    <h1 class="title"><b>The Game</b></h1>
                    <br>
                    <div class="container">
                        <div id="logindiv">
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
