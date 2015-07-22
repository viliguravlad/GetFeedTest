@extends('app')

@section('email')

	<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Home</title>                   
        </head>

        <body>

            <h2>Verify Your Email Address</h2>
            
            <div>
            	Thanks for creating an account with the verification demo app.
                Please follow the link below to verify your email address
                {{ URL::to('auth/verify/' . $user->confirmation_code) }}.
            </div>

        </body>
    </html>

@stop
