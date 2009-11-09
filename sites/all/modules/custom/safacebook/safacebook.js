function fbFriends() {
    var widget_div = document.getElementById("profile_pics");
    FB.ensureInit(function () {
        FB.Facebook.get_sessionState().waitUntilReady(function() {
                FB.Facebook.apiClient.friends_get(null, function(result) {
                    var markup = "";
                    var num_friends = result ? Math.min(5, result.length) : 0;
                    if (num_friends > 0) {
                        for (var i=0; i<num_friends; i++) {
                            markup += '<fb:profile-pic size="square" uid="'+result[i]+'" facebook-logo="true"></fb:profile-pic>';
                        }
                    }
                    widget_div.innerHTML = markup;
                    FB.XFBML.Host.parseDomElement(widget_div);
                });
        });
    });
}


function facebook_onlogin() {
    alert("all logged in");
}


jQuery(document).ready(function($){
   
    
    
});