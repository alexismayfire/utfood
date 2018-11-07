(function () {
    'use strict';

    angular
    .module('PratoDoDiaApp')
    .config([
        	'$stateProvider', '$urlRouterProvider', '$locationProvider', 'appSettings',
        	function($stateProvider, $urlRouterProvider, $locationProvider, appSettings)
            {

        		$urlRouterProvider.when('', '/');
                /*
        		$urlRouterProvider.when('/estabelecimentos', {
        		    templateUrl: appSettings.appUrl + '/app/estabelecimentos/estabelecimentos.html',
                    controller: 'EstabelecimentosController'
                });
                */
                $urlRouterProvider.otherwise('/');

				// @see https://stackoverflow.com/a/27605371/1003020
				$stateProvider.state('app', {
					abstract: true,
					views: {
						toolbar: {
							templateUrl : appSettings.appUrl + '/app/toolbar/toolbar.html',
							controller  : 'ToolbarController',
							controllerAs: 'Toolbar'
						},
						navigation: {
							templateUrl : appSettings.appUrl + '/app/navigation/navigation.html',
							controller  : 'NavigationController',
							controllerAs: 'Navigation'
						},
						'': {
							templateUrl : appSettings.appUrl + '/app/content/content.html',
							controller  : 'ContentController',
							controllerAs: 'Content'
						},   
						footer: {
							templateUrl : appSettings.appUrl + '/app/footer/footer.html',
							controller  : 'FooterController',
							controllerAs: 'Footer'
						}
					}
				})
				.state('app.home', {
					url         : '/',
					templateUrl : appSettings.appUrl + '/app/home/home.html',
					controller  : 'HomeController',
					controllerAs: 'Home'
				})
				.state('app.estabelecimentos', {
				    url: '/estabelecimentos',
                    templateUrl: appSettings.appUrl + '/app/estabelecimentos/estabelecimentos.html',
                    controller: 'EstabelecimentosController',
                    controllerAs: 'Estabelecimentos'
                });

				$locationProvider.html5Mode(true);
            }
    	]);

})();
