function addHelpBubbles() {

    // insert javascript popup dialogs for selected fields
    $('<div id="reg-website-help"></div>').insertBefore('form#user-register table#field_profile_websites_values');
    $('<div id="reg-affiliations-help"></div>').insertBefore('form#user-register table#field_memberships_affiliations_values');
    $('<div id="reg-research-help"></div>').insertBefore('form#user-register table#field_research_interests_values');
    $('<div id="reg-courses-help"></div>').insertBefore('form#user-register table#field_courses_taught_values');
    
    $('<div id="reg-website-help"></div>').insertBefore('body.page-user form#node-form table#field_profile_websites_values');
    $('<div id="reg-affiliations-help"></div>').insertBefore('body.page-user form#node-form table#field_memberships_affiliations_values');
    $('<div id="reg-research-help"></div>').insertBefore('body.page-user form#node-form table#field_research_interests_values');
    $('<div id="reg-courses-help"></div>').insertBefore('body.page-user form#node-form table#field_courses_taught_values');
    
    
    
    var $websiteHelp = $('table#field_profile_websites_values + div').dialog({
			autoOpen: false,
			title: 'Websites',
                        height: 200
		});
    
    $('#reg-website-help').hover(function() {
                    $websiteHelp.dialog('open');              
    }, function() {
                    $websiteHelp.dialog('close');
    });

    var $affiliationsHelp = $('table#field_memberships_affiliations_values + div').dialog({
			autoOpen: false,
			title: 'Memberships & Affiliations',
                        width: 350,
                        height: 100
		});

    $('#reg-affiliations-help').hover(function() {
                    $affiliationsHelp.dialog('open'); 
    }, function() {
                    $affiliationsHelp.dialog('close');                   
    });
    

    var $researchHelp = $('table#field_research_interests_values + div').dialog({
			autoOpen: false,
			title: 'Research Interests',
                        height: 120
		});
    
    $('#reg-research-help').hover(function() {
                    $researchHelp.dialog('open');              
    }, function() {
                    $researchHelp.dialog('close');
    });


    var $coursesHelp = $('table#field_courses_taught_values + div').dialog({
			autoOpen: false,
			title: 'Courses Taught',
                        height: 100
		});
    
    $('#reg-courses-help').hover(function() {
                    $coursesHelp.dialog('open');              
    }, function() {
                    $coursesHelp.dialog('close');
    });

}


jQuery(document).ready(function($){
   
   addHelpBubbles();

});