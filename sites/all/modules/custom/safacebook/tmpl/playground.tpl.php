<div id="fb">
        <div id="fb-inner">
                <?php if (!$logged_in): ?>
                    You're not logged in.
                <?php else: ?>
                        <div id="facebook-login">
                                <fb:login-button v="2" size="medium" onlogin="facebook_onlogin();">Connect with Facebook</fb:login-button>  <!-- onlogin callback -->
                        </div>
                        <fb:profile-pic uid="loggedinuser" size="square" facebook-logo="true"></fb:profile-pic>
                        <fb:name uid="loggedinuser" useyou="false" linked="true"></fb:name>
                    
                        <div id="fb-friends">
                                Friends:    
                                <div id="profile_pics"></div>
                                <script>
                                    fbFriends();
                                </script>
                        </div>    
                <?php endif; ?> <!-- if logged in/else -->
        </div>
</div>