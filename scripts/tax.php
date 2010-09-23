<?php


function add_taxonomy_term($name, $vid, $description = '', $weight = 0) {

  $form_values = array();
  $form_values['name'] = $name;
  $form_values['description'] = $description;
  $form_values['vid'] = $vid;
  $form_values['weight'] = $weight;
  taxonomy_save_term($form_values);

  return $form_values['tid'];
}


function get_universities() {
    $unis = db_query('SELECT title FROM {node} WHERE type="university" ORDER BY title');
    return $unis;
}


function process_universities($unis) {
    $vid = 6; // university vocabulary
    while ($uni = db_fetch_object($unis)) {
        print $uni->title . "\n";
        add_taxonomy_term($uni->title, $vid, $uni->title);
    }
}


function get_university_tax_tid($profile) {
    //print_r($profile);
    $terms = taxonomy_node_get_terms($profile);
    print "Get University tax tid: \n";
    print_r($terms);
    foreach ($terms as $term) {
        if ($term->vid==6) {
            print "returning $term->tid \n";
            return $term->tid;
        }
    }
    print "no existing uni tax tid for this user\n";
    return NULL;
}


function get_academic_discipline_tax_tid($profile) {
    //print_r($profile);
    $terms = taxonomy_node_get_terms($profile);
    print "Get Discipline tax tid: \n";
    print_r($terms);
    foreach ($terms as $term) {
        if ($term->vid==5) {
            print "returning $term->tid \n";
            return $term->tid;
        }
    }
    print "no existing discipline tax tid for this user\n";
    return NULL;
}


function convert_university($uid) {
    // get current university from field
    $profile = content_profile_load('profile', $uid);
    //print_r($profile);
    if ($university_id = $profile->field_university[0]['nid']) {
        print "user $uid has university\n";
        $university = db_fetch_object(db_query("SELECT title FROM {node} WHERE nid=$university_id"));
        print "The university is $university->title \n";
        $university_term = taxonomy_get_term_by_name($university->title);
        print_r($university_term);
        if ($university_term[0]) {
            $tid = $university_term[0]->tid;
            db_query("UPDATE {content_type_profile} SET field_university_tax_value=$tid WHERE nid=$profile->nid");
            print "University update query run. set university tax value to $tid for profile nid $profile->nid \n";
            $utid = get_university_tax_tid($profile);
            if ($utid) {
                // update the taxonomy entry - otherwise, insert one
                db_query("UPDATE {term_node} SET tid=$tid WHERE tid=$utid");
                print "Updated taxonomy from $utid to $tid \n\n";
            }
            else {
                db_query("INSERT INTO {term_node} (nid, vid, tid) values ($profile->nid, $profile->nid, $tid)");
                print "Inserted term entry $profile->nid, $profile->nid, $tid \n\n";
            }
        }
    }
    else {
        print "no university for $uid \n";
    }
    
    // find that university in taxonomy, and assign to that user's profile
    
}


function convert_discipline($uid) {
    // get current university from field
    $profile = content_profile_load('profile', $uid);
    //print_r($profile);
    if ($dis = $profile->field_academic_discipline[0]['value']) {
        print "user $uid has a discipline\n";
        $discipline_term = taxonomy_get_term_by_name($dis);
        print_r($discipline_term);
        if ($discipline_term[0] && $discipline_term[0]->vid==5) {
            $tid = $discipline_term[0]->tid;
            //$tid = $university_term[0]->tid;
            db_query("UPDATE {content_type_profile} SET field_discipline_tax_value=$tid WHERE nid=$profile->nid");
            print "Discipline update query run. set discipline tax value to $tid for profile nid $profile->nid \n";
            $utid = get_academic_discipline_tax_tid($profile);
            if ($utid) {
            //    // update the taxonomy entry - otherwise, insert one
                db_query("UPDATE {term_node} SET tid=$tid WHERE tid=$utid");
                print "Updated taxonomy from $utid to $tid \n\n";
            }
            else {
                db_query("INSERT INTO {term_node} (nid, vid, tid) values ($profile->nid, $profile->nid, $tid)");
                print "Inserted term entry $profile->nid, $profile->nid, $tid \n\n";
            }
        }
    }
    else {
        print "no discipline for $uid \n";
    }
    
    // find that university in taxonomy, and assign to that user's profile
    
}


function user_helper($uid) {
    $profile = content_profile_load('profile', $uid);
    $tid = get_academic_discipline_tax_tid($profile);
    if ($tid) {
        print "The current discipline taxonomy tid for user $uid is $tid \n";
    }
    else {
        print "User $uid has no discipline taxonomy term. \n";
    }
}


function user_helper2($uid) {
    $profile = content_profile_load('profile', $uid);
    $tid = get_university_tax_tid($profile);
    if ($tid) {
        print "The current university taxonomy tid for user $uid is $tid \n";
    }
    else {
        print "User $uid has no university taxonomy term. \n";
    }
}


function show_user($uid) {
    $profile = content_profile_load('profile', $uid);
    print_r($profile);
}



function process_all_users() {
    $users = db_query("SELECT uid FROM {users} where uid>0 ORDER BY uid");
    while ($u = db_fetch_object($users)) {
        convert_discipline($u->uid);
    }
}


/* MAIN */
//$unis = get_universities();
//process_universities($unis);
//user_helper(4);
//user_helper(73);
//convert_university(4);
//convert_discipline(4);
//convert_university(73);
//show_user(4);
//process_all_users();

print "test!!\n\n";
print 'waiting...';
print "\n";
$line = trim(fgets(STDIN));
print "thanks!\n";

print "\n\n";



?>