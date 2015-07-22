    /**
    |--------------------------------------------------------------------------
    | Vkontakte related functions.
    |--------------------------------------------------------------------------            
    */ 

    /**
    *
    * Login and get user's wall posts.
    *
    */
    function vkLoginAndGetFeed () {
        VK.init({
            apiId: 5002870 
        });

        /* Login */
        VK.Auth.login(function(response) {
            if (response.session) {
                updateDatabase('vk', response.session.mid);
                if (response.settings) {
                    console.log(response.settings);
                }
            } else {
                console.log('Fail!');
            }
        }, 8194);

        /* Get user's wall posts */
        VK.Api.call('wall.get', {settings:8194}, function(data) {
            if(data.response) {
                //console.log(data.response);
                var html = '';
                $('.posts').html(html);
                $('.twttr').html(html);
                $('.gplus').html(html);
                $('.gplus').css("background-color", "#333");
                
                html += '<table class="table table-bordered header-fixed" data-toggle="table" data-height="299" border=' + '1' + '>';
                html += '<thead>';
                html += '<tr>';
                html += '<th><div style="width: 500px">Vkontakte posts</div></th>';
                html += '<th><div style="width: 150px">Time created</div></th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';

                for(var i = 1; i < 9; i++) {
                    html += '<tr>';
                    html +=     '<td><div style="width: 500px">' + data.response[i].text + '</div></td>';
                    html +=     '<td><div style="width: 150px">' + _timeSince(new Date(data.response[i].date * 1000)) + ' ago</div><br><br></td>';
                    html += '</tr>';
                }
                html += '</tbody>';
                html += '</table>';
                $('.posts').html(html);
            }
        });
    }