<?php
// $Id: user-profile.tpl.php,v 1.2.2.1 2008/10/15 13:52:04 dries Exp $

/**
 * @file user-profile.tpl.php
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * By default, all user profile data is printed out with the $user_profile
 * variable. If there is a need to break it up you can use $profile instead.
 * It is keyed to the name of each category or other data attached to the
 * account. If it is a category it will contain all the profile items. By
 * default $profile['summary'] is provided which contains data on the user's
 * history. Other data can be included by modules. $profile['user_picture'] is
 * available by default showing the account picture.
 *
 * Also keep in mind that profile items and their categories can be defined by
 * site administrators. They are also available within $profile. For example,
 * if a site is configured with a category of "contact" with
 * fields for of addresses, phone numbers and other related info, then doing a
 * straight print of $profile['contact'] will output everything in the
 * category. This is useful for altering source order and adding custom
 * markup for the group.
 *
 * To check for all available data within $profile, use the code below.
 *
 * @code
 *   print '<pre>'. check_plain(print_r($profile, 1)) .'</pre>';
 * @endcode
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-field.tpl.php
 *   Where the html is handled for each item in the group.
 *
 * Available variables:
 *   - $user_profile: All user profile data. Ready for print.
 *   - $profile: Keyed array of profile categories and their items or other data
 *     provided by modules.
 *
 * @see template_preprocess_user_profile()
 */
?>
<div class="profile">
  <div id="fb-picture">
    <?php
          $facebook_pic_main = safacebook_get_user_photo_main($account->uid);
    ?>
    <img src="<?php print $facebook_pic_main; ?>" />
  </div>
  <div class="profile-role">
    <?php //print $main_role; ?>
    <?php print $account->user_type; ?>
  </div>
  <?php print $profile['content_profile']; ?>
  <?php //print $user_profile; ?>
</div>
<?php //print '<pre>'. check_plain(print_r($account, 1)) .'</pre>'; ?>
<?php //print '<pre>'. check_plain(print_r($user, 1)) .'</pre>'; ?>
