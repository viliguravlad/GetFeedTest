    /**
    |--------------------------------------------------------------------------
    | Facebook related functions.
    |-------------------------------------------------------------------------- 
    |
    | Authorization and user's feed from timeline.
    |          
    */

    /**
     * Check if the user authorized properly.
     *
     */
    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                loginAPI();
            }
        });
    }

    /**
    * Asynchronous Facebook API initialization.
    * 
    */
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1604896263098939',
            xfbml      : true,
            version    : 'v2.4'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    
    /**
     * Login with Facebook API.
     * 
     */
    function loginAPI() {
        FB.api('/me', function(response) {
            console.log('Successful login for: ' + response.name);
        });
    }

    /**
     * Get feed for logged in user.
     * 
     * *****IMPORTANT NOTICE!*****
     *
     * According to Facebook's API permission rules I can not make my 
     * application accessible for everyone. Please, contact me at 
     * bandsonvela@gmail.com pointing out your Facebook username or 
     * email and I'll provide you with needed permissions.
     *
     */
    function getFacebookFeed() {
        FB.login(function(response) {
            if (response.authResponse) {
                updateDatabase('facebook', response.authResponse.userID);
                FB.api('/me/feed?limit=10', function(response) {
                    console.log(response);
                    var html = '';
                    $('.posts').html(html);
                    $('.twttr').html(html);
                    $('.gplus').html(html);
                    $('.gplus').css("background-color", "#333");
                    
                    html += '<table class="table table-bordered header-fixed" data-toggle="table" data-height="299" border=' + '1' + '>';
                    html += '<thead>';
                    html += '<tr>';
                    html += '<th><div style="width: 500px">Facebook posts</div></th>';
                    html += '<th><div style="width: 150px">Time created</div></th>';
                    html += '</tr>';
                    html += '</thead>';
                    html += '<tbody>';

                    for(var i = 0; i < 8; i++) {
                        html += '<tr>';
                        html +=     '<td><div style="width: 500px">' + response.data[i].message + '</div></td>';
                        html +=     '<td><div style="width: 150px">' + _timeSince(new Date(response.data[i].created_time)) + ' ago</div><br><br></td>';
                        html += '</tr>';
                    }
                    html += '</tbody>';
                    html += '</table>';
                    $('.posts').html(html);
                });
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {scope: 'manage_pages,email,publish_actions,public_profile,user_posts,user_status'});
    };