    /**
    *
    * Google+ related functions.
    *            
    */ 

    function getGplusTimeline(user_id) {

        var api = 'https://www.googleapis.com/plus/v1/people/',
            user = user_id,
            apiend = '/activities/public',
            key = 'AIzaSyDAVOMugZj0B-2NGi2TuQxIKWNSHbxYaKk',
            fields = 'items(published,title,url,object(content),actor(displayName,url,image(url)))',
            maxResults = 5;
         
        $.ajax({
            url: api + user + apiend + '?key=' + key + '&fields=' + fields + '&maxResults=' + maxResults,
            crossDomain: true,
            dataType: 'jsonp'
        }).done(function (data) {
         
            var me = this,
                items = data.items,
                i = 0,
                html = '';
         
            for (i = 0; i < items.length; i += 1) {
                html += '<div class="itm">';
                html += '<div class="athr"><a href="' + items[i].actor.url + '" target="_blank" data-track="gplus|click|' + items[i].actor.displayName + '"><img src="' + items[i].actor.image.url + '" alt="" /><div class="name">' + items[i].actor.displayName + '<p class="username">' + user + '</p></div></a><div class="time">' + _timeSince(new Date(items[i].published).getTime()) + '</div></div>';
                html += '<div class="cntnt"><p>' + items[i].object.content + '</p></div>';
                html += '</div>';
            }
            $('.gplus').html(html);
         
        });
    }
     
    function _timeSince(date) {
        var s = Math.floor((new Date() - date) / 1000),
            i = Math.floor(s / 31536000);
     
        if (i > 1) {
            return i + "y";
        }
        i = Math.floor(s / 2592000);
        if (i > 1) {
            return i + "m";
        }
        i = Math.floor(s / 86400);
        if (i > 1) {
            return i + "d";
        }
        i = Math.floor(s / 3600);
        if (i > 1) {
            return i + "h";
        }
        i = Math.floor(s / 60);
        if (i > 1) {
            return i + "m";
        }
        return Math.floor(s) + "s";
    }

    /*function loginGplus() {
        window.location = "http://localhost:8000/posts/google";
        document.getElementById('gplus-btn').hidden = false;
    }*/