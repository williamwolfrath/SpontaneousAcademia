<div id="fb-active-users">
    <div id="fb-active-users-title">Active Members</div>
    <?php foreach ($active_users as $active_user): ?>
        <div class="fb-active-user">
            <img src="<?php print $active_user[0]['pic_square']; ?>" />
        </div>
    <?php endforeach; ?>
</div>