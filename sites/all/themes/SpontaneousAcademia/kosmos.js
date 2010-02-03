function addPictureLinks() {   // this fixes a problem in IE6 where facebook photos interfere with the link that surrounds them
    $('.fb-active-user').each(function() {
        $(this).click(function() {
            window.location = $(this).find('a').attr('href');
        });
    });
    
    $('.recent-post-user-picture').each(function() {
        $(this).click(function() {
            window.location = $(this).find('a').attr('href');
        });
    });
    
    $('.facebook-user-picture').each(function() {
        $(this).click(function() {
            window.location = $(this).find('a').attr('href');
        });
    });
}


function firefoxFixes() {
        if($.browser.mozilla) {
            $('#edit-search-block-form-1').css({'padding-top': '6px'});  // firefox won't vert align the text properly
        }
}



jQuery(document).ready(function($){
   
    $('#block-menu-primary-links .content ul.menu').droppy({speed: 10});
    addPictureLinks();
    firefoxFixes();
    
});