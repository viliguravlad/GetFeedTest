@extends('app')

@section('posts')

    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Posts</title>

            <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
            <link href="{{ asset('css/posts.css') }}" rel="stylesheet">
            <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
            <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">                     
        </head>

        <body>
            <meta name="csrf-token" content="{!! Session::token() !!}">

            <script src="{{ asset('js/updateDB.js') }}"></script>
            <script src="{{ asset('js/fbInteract.js') }}"></script>
            <script src="{{ asset('js/twtrInteract.js') }}"></script>
            <script src="{{ asset('js/vkInteract.js') }}"></script>
            <script src="//vk.com/js/api/openapi.js"></script>
            <script src="https://apis.google.com/js/client:plus.js"></script>
            <script src="{{ asset('js/gplusInteract.js') }}"></script>
            
            <div class="site-wrapper">
                <div class="site-wrapper-inner">
                    <div class="cover-container">
                        
                        <div class="masthead clearfix">
                            <div class="inner">

                                <h3 class="masthead-brand">Get timeline</h3>

                                <ul class="nav masthead-nav masthead-left">
                                    <!-- Facebook button -->
                                    <li><button id="fb-btn" class="btn btn-default" onclick="getFacebookFeed()">Get facebook posts!</button></li>

                                    <!-- Twitter button -->
                                    <li><button id="twttr-btn" class="btn btn-default" onclick="loginTwitter()">Get tweets!</button></li>
                                    
                                    <!-- Vkontakte button -->
                                    <li><button id="vk-btn" class="btn btn-default" onclick="vkLoginAndGetFeed()">Get vk feed!</button></li>
                                    
                                    <!-- 
                                      -  Goggle+ button
                                      - 
                                      -  *****IMPORTANT NOTICE!*****
                                      -  
                                      -  After reloading page you should login to Google+ again in order
                                      -  to view user's timeline. This is in a development mode.
                                      -  Sorry for temporary inconvinience.
                                      - 
                                    -->
                                    <li class="dropdown">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Google+
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                            <a href="/posts/google" class="btn btn-link btn-block">Login G+</a>
                                            <button id="gplus-btn" class="btn btn-link btn-block" onclick="getGplusTimeline('{{ Session::get('google_id') }}')">Get Google+ timeline!</button>
                                        </ul>
                                    </li>
                                    
                                    <li></li>

                                    <!-- Logout button -->
                                    <li class="dropdown">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->email }}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                                            <li><a href="/auth/logout">Выйти</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>    

                        <div class="inner cover">
                            
                            <!-- For Facebook and Vkontakte posts -->
                            <div class="posts col-xs-4 col-xs-offset-3" style="text-align:center"></div>

                            <!-- For Twitter timeline -->
                            <div class="twttr" style="text-align:center">
                                @if(Session::has('twitter_id'))
                                    <a class="twitter-timeline" id="twttr-timeline"
                                        href="https://twitter.com/intent/user?user_id={{ Session::get('twitter_id') }}" 
                                        data-widget-id="623089436117594113"
                                        data-user-id="{{ Session::get('twitter_id') }}">Get tweets!
                                    </a>
                                @endif
                            </div>

                            <!-- For Google+ timeline -->
                            <div style="text-align:center; width:650px" class="col-xs-offset-3">
                                <div class="gplus"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="{{ asset("js/bootstrap.min.js") }}"></script>

        </body>
    </html>

@stop