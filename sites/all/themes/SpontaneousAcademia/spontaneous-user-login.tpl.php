Creating a Kosmos account:

<form id="user-login" method="post" accept-charset="UTF-8" action="/user">

<div><div id="edit-openid-identifier-wrapper" class="form-item">
 <label for="edit-openid-identifier">Log in using OpenID: </label>
 <input type="text" class="form-text" value="" size="58" id="edit-openid-identifier" name="openid_identifier" maxlength="255">
 <div class="description"><a href="http://openid.net/" class="ext">What is OpenID?</a><span class="ext"></span></div>
</div>
 
<div id="login-form-name-password-fields">
<div id="edit-name-wrapper" class="form-item">
 <label for="edit-name">Username: <span title="This field is required." class="form-required">*</span></label>
 <input type="text" class="form-text required" value="" size="60" id="edit-name" name="name" maxlength="60">
 <div class="description">Enter your Kosmos username.</div>
</div>

<div id="edit-pass-wrapper" class="form-item">
 <label for="edit-pass">Password: <span title="This field is required." class="form-required">*</span></label>
 <input type="password" class="form-text required" size="60" maxlength="128" id="edit-pass" name="pass">
 <div class="description">Enter the password that accompanies your username.</div>
</div>
</div>

<input name="form_build_id" id="<?php print $form['form_build_id']['#id']; ?>" value="<?php print $form['form_build_id']['#value']; ?>" type="hidden">
<input type="hidden" value="user_login" id="edit-user-login" name="form_id">
<input type="hidden" value="http://www.spontaneousacademia.org/openid/authenticate?destination=user" id="edit-openid.return-to" name="openid.return_to">



<input type="submit" name="op" id="edit-submit-login" value="Log in"  class="form-submit" />

</div></form>
<br/>
<div id="login-options-block">
<div class="login-options-header">Connect with Facebook</div>
<fb:login-button v="2" onlogin="window.location=window.location.href + '?login=fb'"><fb:intl>Connect with Facebook</fb:intl></fb:login-button><br/>
Facebook members can log onto third-party websites with their Facebook identity.  Privacy settings from your Facebook account will follow you around the web, protecting your information.
<br/><br/>

<div class="login-options-header">OpenID and Google</div>
<form action="/lightopenid/googleauth.php?login" method="post">
    <input type="image" src="/sites/all/themes/SpontaneousAcademia/images/google_login_button.jpg">
</form>
<div class="item-list"><ul><li class="openid-link first"><a href="/%2523">Log in using OpenID</a></li>
<li class="user-link last"><a href="/%2523">Cancel OpenID login</a></li>
</ul></div>
Don't have a Facebook account? Prefer not to link your Kosmos account with Facebook?<br/>

Create your login through OpenID.  Similar in concept to Facebook Connect, OpenID allows you to use an existing account (such as Yahoo, flickr, etc) to sign in to multiple websites without needing to create new passwords. You can also sign in using your Google account. With OpenID and Google, you control how much of your information is shared with the websites you visit.
</div>



<!--<input type="submit" class="form-submit" value="Log in" id="edit-submit" name="op">-->
<!---->
<!--<br/><br/><fb:login-button v="2" onlogin="window.location=window.location.href + \'?login=fb\'"><fb:intl>Connect with Facebook</fb:intl></fb:login-button>-->
<!--<br/><br/>-->
<!---->
<!---->
<!--</div></form>-->
<!---->
<!---->
<!--<form action="/lightopenid/googleauth.php?login" method="post">-->
<!--    <input type="image" src="/sites/all/themes/SpontaneousAcademia/images/google_login_button.jpg">-->
<!--</form>-->
<!--<br/>-->
<!--<div class="item-list"><ul><li class="openid-link first openid-processed"><a href="/%2523">Log in using OpenID</a></li>-->
<!--<li class="user-link last openid-processed"><a href="/%2523">Cancel OpenID login</a></li>-->
<!--</ul></div>-->