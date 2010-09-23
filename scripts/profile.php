<?php


//$profile = content_profile_load('profile', 4);
$vocab = 7;

$result = db_query("SELECT n.nid, uid FROM {content_field_res_int_tax} as c inner join {node} as n on c.nid=n.nid");
while ($u = db_fetch_object($result)) {
        print_r($u);
        $profile = content_profile_load('profile', $u->uid);
        //print_r($profile);
        $delta = 0;
        if ( $profile->field_research_interests ) {
        
        foreach ( $profile->field_research_interests as $i ) {
                //$term = strtolower($i['value']);
                $term = $i['value'];
                if ( $term != "" ) {
                        print "term: " . $term . "\n";
                        $exists = taxonomy_get_term_by_name($term);
                        print "Exists? " . print_r($exists) . "\n";
                        //$line = trim(fgets(STDIN));
                        if ( empty($exists) ) {
                                print "Term $term is not a taxonomy term - adding...\n";
                                $tid = add_taxonomy_term($term, $vocab);
                                // add the term to the cck field and the node's taxonomy
                                if ($delta == 0) {
                                        print "Type a key to update field...\n";
                                        //$line = trim(fgets(STDIN));
                                        $mysql = "UPDATE {content_field_res_int_tax} SET field_res_int_tax_value=$tid WHERE nid=$profile->nid and delta=0";
                                        print "$mysql \n";
                                        //$line = trim(fgets(STDIN));
                                        //$res = db_query("UPDATE {content_field_res_int_tax} SET field_res_int_tax_value=%d WHERE nid=%d and delta=0", $tid, $node->nid );
                                        $res = db_query($mysql);
                                        print "update result: $res \n";
                                }
                                else {
                                        print "Type a key to insert tax value\n";
                                        //$line = trim(fgets(STDIN));
                                        $mysql = "INSERT INTO {content_field_res_int_tax} (nid, vid, delta, field_res_int_tax_value) values ($profile->nid, $profile->vid, $delta, $tid)";
                                        print "$mysql \n";
                                        //$line = trim(fgets(STDIN));
                                        //db_query("INSERT INTO {content_field_res_int_tax} (nid, vid, delta, field_res_int_tax_value) values ($profile->nid, $profile->nid, $delta, $tid)");
                                        $res = db_query($mysql);
                                        print "update result: $res \n";
                                }
                                $mysql = "INSERT INTO {term_node} (nid, vid, tid) values ($profile->nid, $profile->vid, $tid)";
                                print "$mysql \n"; 
                                $res = db_query($mysql);
                                print "update result: $res \n";
                                print "Term association inserted into db.\n";
                        }
                        else {
                                $add = TRUE;
                                print "Term $term exists...\n";
                                print_r($exists);
                                foreach ($exists as $term2) {
                                        print("exsting term vid: " . $term2->vid . "\n");
                                        //$line = trim(fgets(STDIN));
                                        if ($term2->vid == $vocab) {
                                                print "Got it\n";
                                                $add = FALSE;
                                                break;
                                        }
                                }
                                if ($add) {
                                        print "Term exists, but not correct vocab?\n";
                                        //$line = trim(fgets(STDIN));
                                        print "Term $term exists in taxonomy, but not the correct vocabulary. Adding...\n";
                                        $tid = add_taxonomy_term($term, $vocab);
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
                                        $mysql = "INSERT INTO {term_node} (nid, vid, tid) values ($profile->nid, $profile->vid, $tid)";
                                        print "$mysql \n"; 
                                        $res = db_query($mysql);
                                        print "update result: $res \n";
                                        print "Term association inserted into db.\n";
                                }
                                else {
                                        $tid = $term2->tid;
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
                                        $mysql = "INSERT INTO {term_node} (nid, vid, tid) values ($profile->nid, $profile->vid, $tid)";
                                        print "$mysql \n"; 
                                        $res = db_query($mysql);
                                        print "update result: $res \n";
                                        print "Term association inserted into db.\n";
                                }
                        }
                        $delta++;
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


?>