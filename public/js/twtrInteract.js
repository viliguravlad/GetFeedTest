    /**
    *
    * Twitter related functions.
    *            
    */
    window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);
     
        t._e = [];
        t.ready = function(f) {
          t._e.push(f);
        };
     
        return t;
    }(document, "script", "twitter-wjs"));

    !function(d,s,id){
        var js, fjs = d.getElementsByTagName(s)[0],
        p = /^http:/.test(d.location) ? 'http' : 'https';
        if(!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src= p+"://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document,"script","twitter-wjs");

    function loginTwitter() {
        window.location = "http://localhost:8000/posts/twitter";
    }