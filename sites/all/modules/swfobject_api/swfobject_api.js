Drupal.behaviors.swfobjectInit = function (context) {
  var settings = Drupal.settings.swfobject_api;
  
  $('.swfobject:not(.swfobjectInit-processed)', context).addClass('swfobjectInit-processed').each(function () {
    var config = settings['files'][$(this).attr('id')];
    swfobject.embedSWF(config.url, $(this).attr('id'), config.width, config.height, config.version, config.express_redirect, config.flashVars, config.params, config.attributes);
  });
};
