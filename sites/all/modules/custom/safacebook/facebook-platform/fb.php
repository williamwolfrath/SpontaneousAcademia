<?php

include('/home/gemiinii/webapps/spontaneousacademia/sites/all/modules/custom/safacebook/facebook-platform/php/facebook.php');

# Creating the facebook object
$facebook = new Facebook('990f0319a7449a516ee2032d33478742', 'ea5a4e831d85d77953e298b890fe8dd4');

print_r($facebook);
print "---------\n";
//print (safacebook_get_user_photo_square(4) . "\n");
$fb_user = $facebook->api_client->users_getinfo('788964277', 'name');
print_r($fb_user);
//$session = $facebook->api_client->auth_getsession();
//print_r($session);


?>
