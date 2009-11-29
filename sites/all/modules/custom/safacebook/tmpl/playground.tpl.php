<div id="fb">
        <div id="fb-inner">
                <?php if (!$logged_in): ?>
                    You're not logged in.
                <?php else: ?>
                        <fb:profile-pic uid="loggedinuser" size="square" facebook-logo="true"></fb:profile-pic><br/>
                        <fb:name uid="loggedinuser" useyou="false" linked="true"></fb:name>
                    
                        <div id="fb-friends">
                                <b>Friends:</b><br/><br/>    
                                <div id="profile_pics"></div>
                                <script>
                                    //fbFriends();
                                </script>
                        </div>
                        <br/><br/>
                        <div id="fb-tags">
                                <b>FB Tags:</b><br/><br/>

                        </div>
                        <div id="fb-api-test">
                                <b>API Testing:</b><br/><br/>
                                FBUser: <?php print $fbuser; ?><br/>
                                Hello <fb:name uid='<?php echo $fbuser; ?>' useyou='false' possessive='false' />!<br/>
                                First name: <?php print $user_details['0']['first_name']; ?><br/>
                                Pic: <img src="<?php print $user_details['0']['pic']; ?>" />
                        </div>
                <?php endif; ?> <!-- if logged in/else -->
        </div>
</div>