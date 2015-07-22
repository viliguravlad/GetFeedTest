@extends('app')

@section('fb')

	<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Facebook feed</title>

            <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
            <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
            <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">                     
        </head>

        <body>
            <meta name="csrf-token" content="{!! Session::token() !!}">

            <script src="{{ asset('js/updateDB.js') }}"></script>
            <script src="{{ asset('js/fbInteract.js') }}"></script>
            
            <div class="site-wrapper">
                <div class="site-wrapper-inner">
                    <div class="cover-container">
                        
                        <div class="masthead clearfix">
                            <div class="inner">

                                <h3 class="masthead-brand">Get timeline</h3>

                                <ul class="nav masthead-nav masthead-left">
                                    <li><button id="fb-btn" class="btn btn-default" onclick="getFacebookFeed()">Get facebook posts!</button></li>
                                    
                                    <li><button id="twttr-btn" class="btn btn-default" onclick="loginTwitter()">Get tweets!</button></li>
                                    
                                    <li><button id="vk-btn" class="btn btn-default" onclick="vkLoginAndGetFeed()">Get vk feed!</button></li>
                                    
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
                            <div style="text-align:center">
                                @for ($i = 0; $i < 5; $i++)  
                                    <div id="fb_post_{{ $i }}" class="col-xs-4 col-xs-offset-4"></div>
                                    <div id="fb_post_time_{{ $i }}" class="col-xs-4 col-xs-offset-10"></div>
                                @endfor       
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