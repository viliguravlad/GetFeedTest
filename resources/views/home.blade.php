@extends('app')

@section('home')

    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Home</title>

            <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
            <link href="{{ asset("css/cover.css") }}" rel="stylesheet">
            <link href="/css/bootstrap-theme.min.css" rel="stylesheet">                     
        </head>

        <body>

            <div class="site-wrapper">
                <div class="site-wrapper-inner">
                    <div class="cover-container">
                        @if(Session::has('successLoginMessage'))
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p class="alert alert-success">{{ Session::get('successLoginMessage') }}</p>
                        @endif
                        <div class="masthead clearfix">
                            <li><a href="/auth/logout">Выйти</a></li>
                        </div>

                        <div class="inner cover">
                            <a href="/posts">Add social network</a>
                        </div>

                        <div class="mastfoot">
                            
                        </div>

                    </div>
                </div>
            </div>

            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="{{ asset("js/bootstrap.min.js") }}"></script>
            <!--<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
        </body>
    </html>

@stop