<div id="fb-active-users">
    <div id="fb-active-users-title">Active Members</div>
    <?php foreach ($active_users as $active_user): ?>
        <div class="fb-active-user">
            <?php if ( strlen($active_user->picture) > 31): ?>
                <a href="/user/<?php print $active_user->uid; ?>"><img src="<?php print $active_user->picture ?>"/></a>
            <?php else: ?>
                <a href="/user/<?php print $active_user->uid; ?>"><fb:profile-pic uid="<?php print $active_user->facebook_id;?>"  size="square" facebook-logo="true" linked="false"></fb:profile-pic></a>
             <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
