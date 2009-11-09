function sessionCheck() {
    alert("This is session check");
}




function grumble() {
    console.log("grumble is running");
    FB.Facebook.get_sessionState().waitUntilReady(function() {
            window.alert("Session is ready");
            //If you want to make Facebook API calls from JavaScript do something like
    });
}

function mumble() {
    alert("mumble");
    FB.Connect.ifUserConnected("/home", null);
}


function detect() {
    //alert("detect start");
    var loggedIn = false;
    //alert("FB is " + FB);
    //FB.init('990f0319a7449a516ee2032d33478742');
    FB.ensureInit(function() {
        //alert("init'd");
        FB.Connect.get_status().waitUntilReady( function( status ) {
            switch ( status ) {
                case FB.ConnectState.connected:
                    //alert("connected")
                    loggedIn = true;
                    break;
                case FB.ConnectState.appNotAuthorized:
                case FB.ConnectState.userNotLoggedIn:
                    //alert("not logged in or not authorized");
                    FB.Connect.requireSession();
                    loggedIn = false;
            }
        });
    });
    //alert("detect end. loggedIn is " + loggedIn);
}

jQuery(document).ready(function($){
   
   //grumble();
   //mumble();
   detect();
    
});