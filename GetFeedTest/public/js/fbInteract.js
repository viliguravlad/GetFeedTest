    /**
    *
    * Facebook related functions.
    *            
    */
    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        
        if (response.status === 'connected') {
            loginAPI();
        }

    // This function is called when someone finishes with the Login Button.
    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1604896263098939',
            xfbml      : true,
            version    : 'v2.4'
        });

        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function loginAPI() {
        FB.api('/me', function(response) {
            // console.log('Successful login for: ' + response.name);
        });
    }

    function getFacebookFeed() {
        FB.login(function(response) {
            if (response.authResponse) {
                updateDatabase('facebook', response.authResponse.userID);
                FB.api('/me/feed?limit=5', function(response) {
                    for(var i=0; i < 5; i++) {
                        document.getElementById('fb_post_' + i).innerHTML = "Message: " + response.data[i].message;
                        document.getElementById('fb_post_time_' + i).innerHTML = "Time: " + new Date(response.data[i].created_time) + "<br><br>";
                    }
                    $('.fb').html(html);
                });
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {scope: 'manage_pages,email,publish_actions,public_profile,user_posts,user_status'});
    };

    function formatDate(date) {
        var formatted_date = new Data(date);
        return formatted_date;
    }

    function logoutFacebook() {
        FB.logout(function(response) {
            console.log('User logged out!');
        });
        document.getElementById('fb-btn').hidden = false;
        document.getElementById('fb-logout-btn').hidden = true;
        for(var i = 0; i < 5; i++) {
            document.getElementById('fb_post_' + i).innerHTML = "";
            document.getElementById('fb_post_time_' + i).innerHTML = "";
        }
    };