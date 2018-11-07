(function () {
    'use strict';

	angular.module('PratoDoDiaApp')
        .controller('HomeController', function HomeController($scope, $http) {

            var self = this;
            /*
            $http.get('http://localhost:8000/users').then(function(response) {
                console.log("foi");
                $scope.users = JSON.stringify(response.data.data);
            });
            */
            self.users = [
                {
                    name: 'Carlos', city: 'Curitiba', id: 1
                }, {
                    name: 'Thiago', city: 'Curitiba', id: 2
                }
            ];
            self.estabelecimento = "";

            self.showDetails = function(user) {
                self.selectedUser = user;
            }
        });
})();
