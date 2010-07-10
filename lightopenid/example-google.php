<?php
# Logging in with Google accounts requires setting special identity, so this example shows how to do it.
require 'openid.php';
try {
    if(!isset($_GET['openid_mode'])) {
        if(isset($_GET['login'])) {
            $openid = new LightOpenID;
            $openid->identity = 'https://www.google.com/accounts/o8/id';
            $openid->required = array('namePerson/friendly', 'contact/email');
            header('Location: ' . $openid->authUrl());
        }
?>
<form action="?login" method="post">
    <button>Login with Google</button>
</form>
<?php
    } elseif($_GET['openid_mode'] == 'cancel') {
        echo 'User has canceled authentication!';
    } else {
        $openid = new LightOpenID;
        //echo 'validate: ' . $openid->validate() . "<br/>";
        //echo 'User ' . ($openid->validate() ? $_GET['openid_identity'] . ' has ' : 'has not ') . 'logged in.';
        if ($openid->validate()) {
            //header('Location: ' . '/user');
            $attrs = $openid->getAttributes();
            $email = $attrs['contact/email'];
            echo ('email: ' . $email);
            // log in person with email 
        }
    }
} catch(ErrorException $e) {
    echo $e->getMessage();
}
