<?php

echo "It worked.";
print "starting...\n";

global $user;
$user->uid = 4;
$user = user_load($user->uid);
print "user loaded\n";
print_r($user);

$profile = content_profile_load('profile', 4);

print_r($profile);
print "nid: $profile->nid \n";

$delta = 0;
//if (FALSE) {
if ( $profile->field_research_interests ) {
        
        foreach ( $profile->field_research_interests as $i ) {
                $interest = strtolower($i['value']);
                if ( $interest != "" ) {
                        print "Interest: " . $interest . "\n";
                        $exists = taxonomy_get_term_by_name($interest);
                        //print "Exists? " . print_r($exists) . "\n";
                        if ( empty($exists) ) {
                                print "Term $interest is not a taxonomy term - adding...\n";
                                $tid = add_taxonomy_term($interest, 6);
                                // add the term to the cck field and the node's taxonomy
                                if ($delta == 0) {
                                        $mysql = "UPDATE {content_field_res_int_tax} SET field_res_int_tax_value=$tid WHERE nid=$profile->nid and delta=0";
                                        print "$mysql \n"; 
                                        //$res = db_query("UPDATE {content_field_res_int_tax} SET field_res_int_tax_value=%d WHERE nid=%d and delta=0", $tid, $node->nid );
                                        $res = db_query($mysql);
                                        print "update result: $res \n";
                                }
                                else {
                                        $mysql = "INSERT INTO {content_field_res_int_tax} (nid, vid, delta, field_res_int_tax_value) values ($profile->nid, $profile->vid, $delta, $tid)";
                                        print "$mysql \n"; 
                                        //db_query("INSERT INTO {content_field_res_int_tax} (nid, vid, delta, field_res_int_tax_value) values ($profile->nid, $profile->nid, $delta, $tid)");
                                        $res = db_query($mysql);
                                        print "update result: $res \n";
                                }
                                $delta++;
                                print "Term association inserted into db.\n";
                                $mysql = "INSERT INTO {term_node} (nid, vid, tid) values ($profile->nid, $profile->vid, $tid)";
                                print "$mysql \n"; 
                                $res = db_query($mysql);
                                print "update result: $res \n";
                        }
                        else {
                                $add = TRUE;
                                print "Term $interest exists...\n";
                                foreach ($exists as $term) {
                                        if ($term->vid == 6) {
                                                $add = FALSE;
                                                break;
                                        }
                                }
                                if ($add) {
                                        print "Term $interest exists in taxonomy, but not the Research Interests vocabulary. Adding...\n";
                                        //$tid = add_taxonomy_term($interest, 6);
                                }
                        }
                       
                }
        }

}



function add_taxonomy_term($name, $vid, $description = '', $weight = 0) {

  $form_values = array();
  $form_values['name'] = $name;
  $form_values['description'] = $description;
  $form_values['vid'] = $vid;
  $form_values['weight'] = $weight;
  taxonomy_save_term($form_values);

  return $form_values['tid'];
}


//$result = db_query("SELECT * FROM {files}");
//print "blah..\n";
//while ($f = db_fetch_object($result)) {
//        print_r($f);
//}

?>
