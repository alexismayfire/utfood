var
  where = 'client' // Adds files only to the client
;

Package.describe({
  name    : 'semantic:ui-css',
  summary : 'Semantic UI - CSS Release of Semantic UI',
  version : '{version}',
  git     : 'git://github.com/Semantic-Org/Semantic-UI-CSS.git',
});

Package.onUse(function(api) {

  api.versionsFrom('1.0');

  api.use('jquery', 'client');

  api.addFiles([
    // icons
    'datepicker/default/assets/fonts/icons.eot',
    'datepicker/default/assets/fonts/icons.svg',
    'datepicker/default/assets/fonts/icons.ttf',
    'datepicker/default/assets/fonts/icons.woff',
    'datepicker/default/assets/fonts/icons.woff2',

    // flags
    'datepicker/default/assets/images/flags.png',

    // release
    'semantic.css',
    'semantic.js'
  ], 'client');

});
