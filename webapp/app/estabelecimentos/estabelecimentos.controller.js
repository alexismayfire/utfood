(function () {
    'use strict';

    angular.module('PratoDoDiaApp')
        .controller('EstabelecimentoController', function EstabelecimentoController($scope) {

            var self = this;
            /*
            $http.get('http://localhost:8000/users').then(function(response) {
                console.log("foi");
                $scope.users = JSON.stringify(response.data.data);
            });
            */

            self.estabelecimento = {
                name: 'Restaurante do Carlos', city: 'Curitiba', id: 1
            }
        });
})();
