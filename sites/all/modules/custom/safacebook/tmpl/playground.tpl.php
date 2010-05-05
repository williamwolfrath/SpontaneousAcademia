<div id="fb">
        <div id="fb-inner">
                <?php if (!$logged_in): ?>
                    You're not logged in.
                <?php else: ?>
                        <fb:profile-pic uid="<?php print $user_details[0]['uid'];?>"  size="square" facebook-logo="true"></fb:profile-pic><br/>
                        <fb:name uid="<?php print $user_details[0]['uid'];?>" useyou="false" linked="true"></fb:name>
                    
                        <div id="fb-friends">
                                <b>Friends:</b><br/><br/>    
                                <div id="profile_pics"></div>
                                <script>
                                    //fbFriends();
                                </script>
                        </div>
                        <hr/>
                        <br/><br/>
                        <div id="fb-tags">
                                <b>FB Tags:</b><br/><br/>

                        </div>
                        <div id="fb-api-test">
                                <b>API Testing:</b><br/><br/>
                                FBUser: <?php print $fbuser; ?><br/>
                                <?php if ($user_details): ?>
                                        Hello <fb:name uid='<?php echo $fbuser; ?>' useyou='false' possessive='false' ></fb:name>!<br/>
                                        Name: <?php print $user_details['0']['first_name']; ?>  <?php print $user_details['0']['last_name']; ?><br/>
                                        <img src="<?php print $user_details['0']['pic_square']; ?>" />
                                <?php endif; ?>
                        </div>
                <?php endif; ?> <!-- if logged in/else -->
        </div>
        <hr/>
        <div id="fb-debug">
                <pre>
                <?php echo print_r($user_details, TRUE); ?>
                </pre>
        </div>
</div>