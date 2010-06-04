<?php

// define these as constants to ensure they're identical everywhere
// (submitted and used as $op==...)
define('CONF_PERM_UPDATE' , t('Update permissions table'));
define('CONF_PERM_ENABLE' , t('Enable conference node permissions'));
define('CONF_PERM_DISABLE' , t('Disable conference node permissions'));
define('CONF_CREATE_PAPER' , t('Create conference contribution type'));
define('CONF_CREATE_REVIEW' , t('Create conference review type'));

/**
 * Conference module configuration settings (was: conference_settings_page)
 *
 * callback defined in conference_menu() for 'path' => 'admin/settings/conference'
 * (see also: http://drupal.org/node/64279#hook-settings)
 *
 * N.B.: upon hitting a submit button (save,update...), this function is called twice in a row!
 *
 * TODO: better separate tasks of "administer conference" and "manage conference"; at least separate
 * and explain better to the admin what he MUST do (roles, content types, node permissions)
 * and what he /can/ pre-configure (e-mail subjects & bodies, timelimit message, ...)
 * but which is in principle the conference manager's business.
 */
function conference_admin_settings() {
  if (!user_access("administer conference"))
    return drupal_access_denied(); 

// drupal_set_title(t('Conference settings')); // page title // specified in hook_menu()

  /* Call the appropriate function if there is something to do with the node_grants table.
   * A hook_submit($form, &$form_state) to do that would seem more elegant to me,
   * but this might replace the system's default hook_submit which sets all the variables,
   * and the fact that this callback is anyway executed twice (whether ..._submit() exists or not)
   * is another reason to not add yet another function to the pool...
   */
  switch ($_REQUEST['op']) {// NB: http://drupal.org/node/64279#post_op does not apply here
    case CONF_PERM_DISABLE: 
      conference_disable_access(); 
      break;// could/should/will be inlined (only 3 SQL's)
      
    case CONF_PERM_ENABLE:
    case CONF_PERM_UPDATE: 
      conference_update_access(1); 
      break; //Loetscher: parameter set to '1' so 'update done' message is shown]
      
    case CONF_CREATE_PAPER:
      conference_create_content (CONF_CREATE_PAPER);
      break;
      
    case CONF_CREATE_REVIEW:
      conference_create_content (CONF_CREATE_REVIEW);
      break;
  }
  // new setting : conf name
  $form['conference_name'] = array(
          '#type' => 'textfield',
          '#title' => t('Conference name'),
          '#default_value' =>  variable_get('conference_name', ''),
          '#description' => t('Please name your conference. This will also appear as the name of the sender of any e-mail sent to contributors & reviewers by this software.'),
          '#weight' => -10,
        );

  if (module_exists('content_copy')) {
    $form['macro'] = array(
      '#type' => 'fieldset',
      '#title' => t('Create conference content type'),
      '#description' => t('Use the link to create conference content type and import preconfigured fields.'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
    );
    
    $form['macro']['intro1'] = array( 
      '#type' => 'item',
      '#value' => t("Normally the conference module uses its own node access permission management, which controls any access to the two content types reserved for paper submission and their reviews (making them only accessible to the respective authors etc.). Thus there should be two dedicated content types used only for this purpose, in addition to all other existing content types of the web site.")
    );
    
    $form['macro']['button_desc1'] = array( 
      '#type' => 'item',
      '#value' => '',
      '#description' => t('This will be the default content type for posting papers.'),
      '#weight' => 2,
    );
        
    $form['macro']['paper_button'] = array(
      '#type' => 'submit',
      '#weight' => 0,
      '#value' => CONF_CREATE_PAPER,
    );
    
    $form['macro']['review_button'] = array(
      '#type' => 'submit',
      '#weight' => 2,
      '#value' => CONF_CREATE_REVIEW,
    );

    $form['macro']['button_desc2'] = array( 
      '#type' => 'item',
      '#value' => '',
      '#description' => t('This will be the default content type for posting reviews.'),
      '#weight' => 2,
    );
  
    $form['macro']['intro2'] = array( 
      '#type' => 'item',
      '#value' => t("If you just enabled above a default content type provided by conference module, you may need to save the settings before being able to select it below.
        <b>After changing this setting, it is necessary to update the node permissions</b>, and <b>all
        previously created submissions of other type won't be handled any more by the conference module</b>, e.g. they won't appear on 'my papers', 'my reviews' and 'manage conference' listings, accessing them will be possible to anybody in the same way as for other pages of the web site, etc."),
      '#weight' => 3,
      // TODO: add option "unpublish nodes" when a previous conf-type is de-selected
  );
  }
  
  $form['ctypes'] = array('#type' => 'fieldset', '#title' => t('Setup content types'));

  $form['ctypes']['intro1'] = array( 
      '#type' => 'item',
      '#value' => t("Once the above content types are created please choose the appropriate names from the values below")
    );
    
  $node_types = node_get_types('names'); // MFH: 'names' missing in 4.x version => does not work with 5.x

  //Set the Default Values of the conference contribution and conference review
  if (array_key_exists('conference_paper', $node_types)) {
    variable_set('conference_ctype_paper', 'conference_paper');
  }
  
  if (array_key_exists('conference_review', $node_types)) {
    variable_set('conference_ctype_review', 'conference_review');
  }
  
  $form['ctypes']['conference_ctype_paper'] = array(
    '#type' => 'select', '#title' => t('Content type for posting papers'),
    '#default_value' => variable_get('conference_ctype_paper', ''),
    '#options' => $node_types, '#description' => t( "This content type will only be viewable and editable by the author. Don't forget to <strong>allow file uploading</strong> for this content type and the associated role."),
    '#weight' => 1,
    );
  $form['ctypes']['conference_expand_upload'] = array(
    '#type' => 'checkbox',
    '#title' => t("Expand upload fieldset in paper creation formular"),
    '#default_value' => variable_get('conference_expand_upload', 1),
    '#weight' => 2,
  );

  //see above : // $node_types = node_get_types('names');
  $form['ctypes']['conference_ctype_review'] = array(
    '#type' => 'select',
    '#title' => t('Content type for posting reviews'),
    '#default_value' => variable_get('conference_ctype_review', ''),
    '#options' => $node_types,
    '#description' => t('This content type will be editable and viewable by its author (the reviewer).'),
    '#weight' => 3,
  );
  $form['ctypes']['conference_hide_title'] = array(
    '#type' => 'checkbox',
    '#title' => t('Hide title-field in review creation formular'),
    '#default_value' => variable_get('conference_hide_title', 0),
    '#weight' => 4,
  );
  
  $form['ctypes']['conference_default_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Default title for reviews'),
    '#default_value' => variable_get('conference_default_title', "Review of %s"),
    '#weight' => 5,
    '#description' => t('"%s" will be substituted by the title of the referring paper. Leave blank to disable this feature.'),
  );

  $form['ctypes']['conference_default_paperid_prefix'] = array(
    '#type' => 'textfield',
    '#title' => t('Default Prefix when generating Paper ID'),
    '#default_value' => variable_get('conference_default_paperid_prefix', ''),
    '#weight' => 5,
    '#required' => TRUE,
    '#description' => t('This will be used to generate a unique ID every time a new paper is submitted, [prefix][number] is the format'),
  );
  
  $form['access'] = array( '#type' => 'fieldset', '#title' => t('Node Permissions'));

  $form['access']['intro'] = array( '#type' => 'item', '#weight' => -1,
    '#value' => t( "The conference module contains a system to manage node permissions. It is neccessary to update the permissions table after installing the module and after changing the content type settings."),
  );// TODO: the module should automatically do the update on such a change, instead of requiring the admin to do it.

  // here if..else is more logical than switch
  if ( variable_get( 'conference_grants', 0)) {
    $form['access']['conference_grants_disable'] = array(
      '#type' => 'submit', 
      '#weight' => 1, 
      '#value' => CONF_PERM_DISABLE, 
    );
    $form['access']['conference_grants_update'] = array(
      '#type' => 'submit', 
      '#weight' => 2, 
      '#value' => CONF_PERM_UPDATE ,
    );
  } 
  else {
    $form['access']['conference_grants_enable'] = array(
      '#type' => 'submit', 
      '#weight' => 1, 
      '#value' => CONF_PERM_ENABLE,
    );
  }

  $form['roles'] = array('#type' => 'fieldset', '#title' => t('Roles'));

  $form['roles']['intro'] = array('#type' => 'item',
          '#value' => t("One role is dedicated to post papers, another to read papers and to post reviews. These settings control the visibility of the corresponding menu items (my papers/my reviews/manage conference), but they don't affect the right to create the corresponding node types, so please check at the <a href='?q=admin/access'>access control page</a> if these permissions are set correctly.")
  );

  $roles = user_roles();
  // MFH: TODO: better filtering of possible roles :
  // 1� role_paper must have create paper_type and upload permission
  
  $form['roles']['conference_role_paper'] = array(
    '#type' => 'select',
    '#title' => t('Role dedicated to post papers'),
    '#default_value' => variable_get('conference_role_paper', 2),// i.e. authenticated user;
    '#options' => $roles, // HERE SELECT THOSE WHO CAN UPLOAD AND CREATE paper_type
    '#description' => t("Users with this role will see a 'My papers' menu item and be able to post contributions. A simple choice would be 'authenticated user'."),
  );
  $form['roles']['conference_role_review'] = array(
    '#type' => 'select',
    '#title' => t('Role dedicated to read papers and to write reviews'),
    '#default_value' => variable_get('conference_role_review', ''),
    '#options' => $roles,//HERE SELECT THOSE WHO CAN create review type
    '#description' => t("Users with this role will see a 'My reviews' menu item and be able to post a review for each contribution they have been assigned to by the conference manager."),
  );
  $form['roles']['conference_role_management'] = array(
    '#type' => 'select',
    '#title' => t('Role dedicated to assign reviewers to papers and to manage the conference'),
    '#default_value' => variable_get('conference_role_management', ''),
    '#options' => $roles,
    '#description' => t("Users with this role see the 'Manage conference' menu item, assign reviewers to contributions, and make decisions concerning acceptation of papers."),
  );

  $form['misc'] = array('#type' => 'fieldset', '#title' => t('Miscellaneous Settings'));
  
  // ---- email 1: assignment
  $form['misc']['email1']= array(
    '#type' => 'fieldset',
    '#title' => t('Inform reviewer about an assignment'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE
  );
  
  $form['misc']['email1']['conference_email_assignment_subject'] = conference_email('assignment_subject');
  $form['misc']['email1']['conference_email_assignment_body'] = conference_email('assignment_body');

  // ---- email 2: reminder
  $form['misc']['email2']= array(
    '#type' => 'fieldset', 
    '#title' => t('Reminder email to reviewer'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE
  );
  
  $form['misc']['email2']['conference_email_reminder_subject'] = conference_email('reminder_subject');
  $form['misc']['email2']['conference_email_reminder_body'] = conference_email('reminder_body');

  // ---- email 3: decision ----
  $form['misc']['email3']= array(
    '#type' => 'fieldset',
    '#title' => t('Information email to author'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE
  );
  $form['misc']['email3']['conference_email_decision_subject'] = conference_email('decision_subject');
  $form['misc']['email3']['conference_email_decision_body'] = conference_email('decision_body');
  $form['misc']['email3']['conference_email_decision_accept'] = conference_email('decision_accept');
  $form['misc']['email3']['conference_email_decision_modify'] = conference_email('decision_modify');
  $form['misc']['email3']['conference_email_decision_reject'] = conference_email('decision_reject');

    // ---- email 4: notify author
  $form['misc']['email4']= array(
    '#type' => 'fieldset', 
    '#title' => t('Notification email to reviewer'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE
  );
  
  $form['misc']['email4']['conference_email_notify_subject'] = conference_email('notify_subject');
  $form['misc']['email4']['conference_email_notify_body'] = conference_email('notify_body');

    // ---- email 5: notify review complete
  $form['misc']['email5']= array(
    '#type' => 'fieldset', 
    '#title' => t('Notification email to when review is complete'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE
  );
  
  $form['misc']['email5']['conference_email_reviewed_subject'] = conference_email('reviewed_subject');
  $form['misc']['email5']['conference_email_reviewed_body'] = conference_email('reviewed_body');
  
  // new setting : conf email
  $form['misc']['conference_email_address'] = array( '#type' => 'textfield', '#title' => t("Conference manager's e-mail"),
    '#default_value' => variable_get('conference_email_address', variable_get('site_mail', '')),//'#weight' => 1, 
    '#description' => t("This will be used in the 'From:' field of e-mails sent to authors or reviewers by the conference software. If you put multiple addresses (separated by ','), only the first one will be used as sender."),
  );

  $form['misc']['conference_cc_manager'] = array( '#type' => 'select', '#title' => t("Send copy to conference manager"),
    '#options' => array( 0 => t("None: don't sent copy to manager"),// 0='none'
      'BCC' => t("Send copies as (hidden) BCC"),// 1='BCC'
      'CC' => t("Send copy as (visible) CC") , ),// 2='CC'
    '#default_value' => variable_get('conference_cc_manager', 'BCC'),//'#weight' => 1, 
    '#description' => t("Should a copy be sent to the above e-mail address(es) whenever an email is sent by the conference software?"),
  );
  
  $form['misc']['conference_two_level'] = array (
    '#type' => 'checkbox',
    '#title' => t('Enable two Level Submission'),
    '#default_value' => variable_get('conference_two_level', FALSE),
    '#description' => t('If checked the user is forced to upload abstract first after approval the user is allowed to upload the Full Paper')
  );
  
  if (!variable_get('conference_grants', 0) // variable set in conference_update_access()
    and empty($GLOBALS['node_perms_error_set']) and $GLOBALS['node_perms_error_set']=1 )//avoid duplicate message
    // Indeed, with the above(second) line, this message would often be printed twice (since this callback 
    // is called first for "submit/validation" (whether a _submit does exist or not), then to print the form.
          drupal_set_message(t('Please enable conference node permissions!'), 'error' );

  return system_settings_form($form); // see also: http://drupal.org/node/64279#hook-settings
}

/**
 * Update the node grants table and enable the conference node permissions.
 *
 * This function is called in conference_settings_page() if "Update..." is clicked.
 *
 * TODO: call this function automatically after relevant settings are modified.
 */
function conference_update_access( $called_from_settings_page=0 ) { /* arg added by Loetscher, default value by MFH */

  // node types must be set
  if ( ! $ctype_paper = variable_get('conference_ctype_paper', 0)
    or ! $ctype_review = variable_get('conference_ctype_review', 0))
   return conference_setup_required();

  // here we define grants to existing nodes, so the time limit is not relevant
  // since it only affects new postings.

  // delete universal view grant and previously inserted conference grants
  db_query( "DELETE FROM {node_access} WHERE (nid = 0 AND realm = 'all') OR realm LIKE 'conference%'" );
//db_query( "DELETE FROM {node_access} WHERE (realm = 'conference') OR (realm = 'conference_all') OR (realm = 'conference_manage')" );

  // insert conference specific grants
  $sql = "INSERT INTO {node_access} (nid, gid, realm, grant_view, grant_update, grant_delete) SELECT ";
  
  // node type: paper, user: creator
  // Papers already assigned to a reviewer are viewable but not editable for the creator,
  // idem if the conference chair made a decision concerning a paper.
  // Other papers are viewable and editable for the creator.
  // TODO: node should become modifiable if modification is requested
  // MFH: added DISTINCT since if a paper has 2 reviews assigned to, this gave a duplicate entry error

  db_query($sql ."DISTINCT n.nid, n.uid, 'conference', 1, !(c.ruid OR d.decision), !(c.ruid OR d.decision)
    FROM {node} n LEFT JOIN {conference} c ON n.nid = c.pnid 
    LEFT JOIN {conference_decision} d ON d.pnid = n.nid WHERE n.type = '%s'", $ctype_paper);

  // node type: paper or review, user: manager - always has READ access
  db_query( $sql ."nid, 1, 'conference_manage', 1, 0, 0 FROM {node} WHERE type = '%s' OR type = '%s'",  $ctype_paper, $ctype_review );
  // CHECK IF THIS IS CORRECT : MANAGER == UID=1 ?

  //N.B.: We don't grant READ access to paper nodes for the assigned reviewers : they can only access the uploaded file
  //(TODO: it might be a choice in settings whether to allow reviewers access the paper nodes)
  
  // node type: review, user: creator
  if ( variable_get( 'conference_decision_locks_review' , 0 ))
    // IF DECISION HAS BEEN TAKEN, REVIEW ALSO GOES READ-ONLY
    db_query( $sql ."DISTINCT nid, uid, 'conference', 1, !d.decision, !d.decision FROM {node}
      LEFT JOIN {conference_decision} d ON d.pnid = nid WHERE type = '%s'", $ctype_review);
  else // if this option is not chosen, reviews remain always editable by their author
    db_query( $sql ."nid, uid, 'conference', 1, 1, 1 FROM {node} WHERE type = '%s'", $ctype_review);

  // all other node types: universal view grant
  db_query( $sql ."nid, 0, 'conference_all', 1, 0, 0 FROM {node} WHERE (type != '%s') AND (type != '%s')", $ctype_paper, $ctype_review );

  // save state and print message
  // (Loetscher: 'if statement' added to prevent message on calls not from conference settings page)
  if ( $called_from_settings_page ) {
    variable_set('conference_grants', 1);
    drupal_set_message("The database has been configured and updated for conference node permissions.");
  }
}

/**
 * Disable conference specific node permissions
 */
function conference_disable_access() {
  db_query("DELETE FROM {node_access} WHERE (nid = 0 AND realm = 'all') OR realm LIKE 'conference%'");
//db_query("DELETE FROM {node_access} WHERE (realm = 'conference') OR (realm = 'conference_all') OR (realm = 'conference_manage')");
  db_query("INSERT INTO {node_access} VALUES (0, 0, 'all', 1, 0, 0)");
  drupal_set_message(t("The default permissions table has been restored. Conference node permissions is disabled."));
  variable_set('conference_grants', 0);
}

function conference_disable() {
  conference_disable_access();
}

/**
 * Creates the appropriate content type
 *
 * @param $type - The content type to create
 */
function conference_create_content ($type) {
  
  include_once './'. drupal_get_path('module', 'node') .'/content_types.inc';
  include_once('./'. drupal_get_path('module', 'content') .'/includes/content.admin.inc');
  $form_state = array();
  $values['values']['type_name'] ='<create>';

  switch ($type) {
    case CONF_CREATE_PAPER:
      $values['values']['macro'] = file_get_contents(drupal_get_path('module', 'conference') .'/conference_paper.cck');
      break;

    case CONF_CREATE_REVIEW:
      $values['values']['macro'] = file_get_contents(drupal_get_path('module', 'conference') .'/conference_review.cck');
      break;
  }
  
  drupal_execute("content_copy_import_form", $values);
  
  drupal_set_message ("Content type was successfully created");
}
