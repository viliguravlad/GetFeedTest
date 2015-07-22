<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;

use App\User;
use Socialite;
use FacebookApi\FacebookApiException;
use Facebook;

class PostsController extends Controller
{
    public function provider($provider) {

        if(\Auth::guest())
            return redirect('auth/login');

        if($provider === 'twitter') {
            return Socialite::with('twitter')->redirect();
        }

        if($provider === "google") {
            return Socialite::with('google')->redirect();
        }
    }

    public function providerCallback($provider) {

        if(\Auth::guest())
            return redirect('auth/login');

        $provider_id_field = $provider . '_id';

        try {
            $user = Socialite::with($provider)->user();
        } 
        catch (Exception $e) {
            return redirect('/posts');
        }
        
        /**
        *
        *   Update record in the Users table
        *
        */
        $providerId = $user->id;
        $updatedOrNot = PostsController::findAndUpdateUser($provider, $providerId);
        
        if($provider === "twitter") {
            return redirect('/posts')->with('twitter_id', $providerId)
                                     ->with('updatedOrNot', $updatedOrNot);
        }

        if($provider === "google") {
            return redirect('/posts')->with('google_id', $providerId)
                                     ->with('updatedOrNot', $updatedOrNot);
        }
    }

    public function googleCallback () {
        
        if(\Auth::guest())
            return redirect('auth/login');

        try {
            $user = Socialite::with('google')->user();
        } 
        catch (Exception $e) {
            return redirect('/posts');
        }

        $providerId = $user->id;
        $updatedOrNot = PostsController::findAndUpdateUser('google', $providerId);

        //echo $providerId;

        return redirect('/posts')->with('google_id', $providerId)
                                 ->with('updateOrNot', $updatedOrNot);
    }

    public function updateDB(Request $request) {

        if(\Auth::guest())
            return redirect('auth/login');
        
        $provider = $request->input('provider');
        $providerId = $request->input('provider_id');
        //echo "$provider and $id";
        $updatedOrNot = PostsController::findAndUpdateUser($provider, $providerId);

        return $updatedOrNot;

    }

    private function findAndUpdateUser($provider, $providerId) {
        
        if(\Auth::guest())
            return redirect('auth/login');

        $provider_id_field = $provider . '_id';

        if ($authUser = User::where($provider_id_field, $providerId)->first()) {
            return "No need for updating!";
        }
        else {
            if($authUser = User::where('email', \Auth::user()->email)->first()) {
                $authUser->$provider_id_field = $providerId;
                $authUser->save();
                return "Successfully updated!";
            }
            return 'No such user!';
        }
    }

}
















































// if($provider === 'facebook') {

        //     $fb = new Facebook\Facebook([
        //         'app_id' => env('FACEBOOK_CLIENT_ID'),
        //         'app_secret' => env('FACEBOOK_CLIENT_SECRET'),
        //         'default_graph_version' => 'v2.4',
        //         'default_access_token' => $user->token,
        //     ]);                
        //     //$helper = $fb->getOAuth2Client();;

        //     try {
        //         $response = $fb->get('/me/accounts?fields=name,access_token,perms');
                
        //         // $request = $fb->request('GET', '/me/feed');
        //         // $response = $request->execute();            
        //     } catch(Facebook\Exceptions\FacebookResponseException $e) {
        //         // When Graph returns an error
        //         echo 'Graph returned an error: ' . $e->getMessage();
        //         exit;
        //     } catch(Facebook\Exceptions\FacebookSDKException $e) {
        //         // When validation fails or other local issues
        //         echo 'Facebook SDK returned an error: ' . $e->getMessage();
        //         exit;
        //     }
        //     var_dump($response);

        //     //dd($response);
            
        //     // $feedEdge = $response->getGraphEdge();
        //     // dd($feedEdge->asArray());
            
        //     //foreach ($feedEdge as $status) {
        //         //dd($status);
        //     //    var_dump($status->asArray());
        //     //}

        //     /*$nextFeed = $fb->next($feedEdge);

        //     foreach ($nextFeed as $status) {
        //         var_dump($status->asArray());
        //     }*/







        //     /*try {


        //     $args = array('access_token' => $fb->getAccessToken(),'limit'=>$this->getLimit());
        //     $feeds =  $fb->api('/'.$this->_config['facebook']['pageId'].'/feed', 'GET', $args);

        //     } catch(FacebookApiException $e) {
        //         echo 'Caught exception: ' .  $e->getMessage() . "\n";
        //         exit;
        //     }*/
        //     //$postsFromProvider = file_get_contents("https://graph.facebook.com/881426101944223" . /*$socialUser->facebook_id .*/ "/feed?access_token=CAAFZAggTcVV0BAGgGO5HIYMXigLKJHhwbKwvuWBSvyz8pw1fLKte5lpE1XTN0sgd2C0ZAeIGXX4yrwgoj37th5qnKz7b4eMZCHgz1Dgg2jGzsTNXs0kTVkKE6bHZBE8ROBFhPURYZBgiwYaxA0qLccmDPZAuzsZCx5jj7ukIbr3XZANUU4pHtrZBBsMeIkVUB4SO8MuZCZBrboakrwnLJea9ZCXZC"); //. $user->token);
        // }

        //dd($postsFromProvider);
        
        //return redirect('posts/' . $provider);