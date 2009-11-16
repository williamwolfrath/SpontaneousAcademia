<?php
// $Id: template.php,v 1.17 2008/09/11 10:52:53 johnalbin Exp $

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to jiiwiz_one_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: jiiwiz_one_breadcrumb()
 *
 *   where jiiwiz_one is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions, please visit the Theme
 *   Developer's Guide on Drupal.org: http://drupal.org/node/223430
 *   For more information on template suggestions, please visit the Theme
 *   Developer's Guide on Drupal.org: http://drupal.org/node/223440 and
 *   http://drupal.org/node/190815#template-suggestions
 */


/*
 * Add any conditional stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that ALWAYS need to be included, you should add them to
 * your .info file instead. Only use this section if you are including
 * stylesheets based on certain conditions.
 */
/* -- Delete this line if you want to use and modify this code
// Example: optionally add a fixed width CSS file.
if (theme_get_setting('jiiwiz_one_fixed')) {
  drupal_add_css(path_to_theme() . '/layout-fixed.css', 'theme', 'all');
}
// */


/**
 * Implementation of HOOK_theme().
 */
//function jiiwiz_one_theme(&$existing, $type, $theme, $path) {
//  $hooks = zen_theme($existing, $type, $theme, $path);
//  // Add your theme hooks like this:
//  /*
//  $hooks['hook_name_here'] = array( // Details go here );
//  */
//  // @TODO: Needs detailed comments. Patches welcome!
//  return $hooks;
//}



// the following has been deprecated in d6 and no longer gets called.
//function _phptemplate_variables($hook, $vars)
//{
//	watchdog('demo', '_phptemplate_var time');
//	switch($hook) {
//		case 'page':
//			if ((arg(0) == 'admin')) {
//				$vars['template_file'] = 'page-booey';
//			}
//			break;
//	}
//	return $vars;
//}


/**
function jiiwiz_one_restaurant_review_list_item($rr_info)
{
	watchdog('restaurant_review', "is this called?");
	return $rr_info->address;
}
*/

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
//function jiiwiz_one_preprocess(&$vars, $hook) {
//	watchdog('demo', 'jiiwiz preprocess');
//  //$vars['sample_variable'] = t('Lorem ipsum.');
//}

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
//function jiiwiz_one_preprocess_page(&$vars, $hook) {
//	watchdog('demo', 'jiiwiz preprocess page');
//	// override the template file with:
//	//$vars['template_files'][] = 'page-bill';
//}

//function phptemplate_preprocess_page(&$vars, $hook)
//{
//	watchdog('booye', 'phpt pre');
//}

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
//function jiiwiz_one_preprocess_node(&$vars, $hook) {
//	watchdog('demo', 'jiiwiz preprocess node');
//  //$vars['sample_variable'] = t('Lorem ipsum.');
//}

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
//function jiiwiz_one_preprocess_comment(&$vars, $hook) {
//	watchdog('demo', 'jiiwiz preprocess comment');
//  //$vars['sample_variable'] = t('Lorem ipsum.');
//}

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
//function jiiwiz_one_preprocess_block(&$vars, $hook) {
//	watchdog('demo', 'jiiwiz preprocess block');
//  //$vars['sample_variable'] = t('Lorem ipsum.');
//}

function SpontaneousAcademia_preprocess_page(&$vars, $hook) {
    global $user;
    //$curr_uri = check_plain(request_uri());
    //log_debug('curr uri: ', $curr_uri);
    include_once(drupal_get_path('module', 'safacebook') . '/facebook-platform/php/facebook.php');
    $api_key = variable_get('safacebook_api_key', '');
    $secret = variable_get('safacebook_secret', '');
    log_debug('api key is ', $api_key);
    log_debug('secret is ', $secret);
    $fb=new Facebook($api_key,$secret);
    log_debug("got a facebook object: ", $fb);
    $fb_user=$fb->get_loggedin_user();
    log_debug("fb_user is ", $fb_user);

    // if the user is logged into facebook, log them into the site if they aren't already.
    // don't log the user in if it's the logout link...
    // if the user is NOT logged into facebook but is still logged in, log them out
    if ( user_is_logged_in() ) {
        log_debug("User is logged in... user obj is ", $user);
        if (!$fb_user) {
            log_debug("no FB user, logging out...");
            drupal_goto('logout');  // reload current page to correctly show User Welcome block
        }
    }
    else {
        log_debug("user is not logged in...");
        if ($fb_user) {
            log_debug("trying to log in user...");
            _login_user($fb_user);
            global $base_root;
            $url = $base_root . request_uri();
            drupal_goto($url);  // reload current page to correctly show User Welcome block
        }
    }
}



function _login_user($fb_user) {
    log_debug("login user: fb_user is ", $fb_user);
    $result = db_query("SELECT * FROM {node} WHERE title = '%s' ", $fb_user);
    if ($fb_mapping = db_fetch_object($result)) {
	log_debug("fb mapping is ", $fb_mapping);
	$node = node_load($fb_mapping->nid);
	log_debug("node obj is ", $node);
	$uid = $node->field_site_id[0][value];
	log_debug('fb mapping uid: ', $uid);
	$site_user = user_load($uid);
	log_debug("site user: ", $site_user);
	user_external_login_register($site_user->name, 'safacebook');
	log_debug("user is now logged in");
    }
}



function SpontaneousAcademia_preprocess_block(&$vars, $hook) {
  log_debug('preprocess block...');
  //log_debug('hook is ', $hook);
  //log_debug('vars: ', $vars);
}

// add the user's main role name to the template
function SpontaneousAcademia_preprocess_user_profile(&$vars) {
    //log_debug('preprocess user profile');
    //log_debug('vars is ', $vars);
    //log_debug('The user object is ', $vars['user']);
    $vars['main_role'] = '';
    foreach ($vars['account']->roles as $role) {
        if (!($role == 'authenticated user')) {
            // get the first role that is NOT auth user
            $vars['main_role'] = $role;
        }
    }
}