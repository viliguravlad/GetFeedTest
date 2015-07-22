
    function vkLoginAndGetFeed () {
        VK.init({
            apiId: 5002870 
        });

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

        VK.Api.call('wall.get', {settings:8194}, function(data) {
            if(data.response) {
                for(var i = 1; i < 6; i++) {
                    document.getElementById('vk_post_' + i).innerHTML = "Message: " + data.response[i].text;
                    document.getElementById('vk_post_time_' + i).innerHTML = "Time: " + formatTime(data.response[i].date) + "<br><br>";
                }
            }
        });
    }

    function formatTime (unix_timestamp) {
        var date = new Date(unix_timestamp * 1000);
        var hours = date.getHours();
        var minutes = "0" + date.getMinutes();
        var seconds = "0" + date.getSeconds();
        var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
        return formattedTime;
    }

    /*function vkLogout() {
      VK.Auth.logout(function(response) {
        console.log(response);
        console.log('Logged out!');
      });

      document.getElementById('vk-logout-btn').hidden = true;
      document.getElementById('vk-btn').hidden = false;
    }*/