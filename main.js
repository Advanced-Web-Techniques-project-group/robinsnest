var items;


// Create a module: 
var storeModule = angular.module('robinsNestStore', ['ngRoute']); 


 // Create our V.A.T. service (any module can use it!): 
 storeModule.factory('Vat', function() { 
    var vat = {}; 
    // we only need to change this line (if the V.A.T. rate changes): 
    vat.rate = 17.5; 
    vat.compute = function(amount) { 
        return amount / 100 * vat.rate; 
    } 
    // we finish by returning the helper object: 
    return vat; 
}); 

 storeModule.config(['$routeProvider', function ($routeProvider) {
  $routeProvider
  .when('/checkout', {
      templateUrl: 'cart.html',
  })
  .when('/shop', {
      templateUrl: 'store.html',
  })
}]);

// Create a controller: 
storeModule.controller('displayItemsController', 
    function ($scope, Vat, $http) { 

        $scope.addToBasket = function (item_id, name, price) {
           if (typeof(Storage) !== "undefined") {
              if(localStorage.getItem('cart') == null)
              {
                 var cart = {};
                 cart[item_id] = [item_id, name, price, 1];
                 localStorage.setItem('cart', JSON.stringify(cart));
             }
             else {
                 var cart = JSON.parse(localStorage.getItem('cart'));
                 var found = false;
                 if(cart[item_id][0] == item_id)
                 {
                    cart[item_id][3]++;
                    found = true;
                }
                if(!found){
                    cart[item_id] = [item_id, name, price, 1];
                }
                localStorage.setItem('cart', JSON.stringify(cart));
            }
            console.log(localStorage.getItem('cart'));
        } else {
            console.log("sessions not supported on this browser");
        }

    };


    $http.get('items.php').
    then(function onSuccess(data, status, headers, config) {
        $scope.items = data.data; 
    }, function onError(response) {
        console.log(response);
    });

    $scope.getVat = function(total) { 
        // use our service to do the calculation: 
        return Vat.compute(total); 
    }  
});