@extends('app')

@section('authLogin')

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Авторизация</title>

        <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("css/signing.css") }}" rel="stylesheet">           
    </head>

    <body>
    	@if (count($errors) > 0)
		  <div class="alert alert-danger">
		    <strong>Ошибка!</strong>
		    There are some problems with your input.<br><br>
		    <ul>
		      @foreach ($errors->all() as $error)
		        <li>{{ $error }}</li>
		      @endforeach
		    </ul>
		  </div>
		@endif

        @if(Session::has('failedLoginMessage'))
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p class="alert alert-success">{{ Session::get('failedLoginMessage') }}</p>
        @endif
		
		<div class="container">          
            <form class="form-signin" role="form" method="post" action="/auth/login">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h2 class="form-signin-heading">Please, log in!</h2>
                <input type="text" class="form-control" name="email" placeholder="email" value="{{ old('email') }}">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <button class="btn btn-lg btn-default btn-block" type="submit">Login</button>
                <a href="/auth/register" class="btn btn-lg btn-default btn-block">Register</a>
            </form>            
        </div>

		<script src="{{ asset("js/bootstrap.min.js") }}"></script>
    </body>
</html>
@endsection