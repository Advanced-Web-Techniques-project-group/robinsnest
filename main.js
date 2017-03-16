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
      controller: 'cartController'
  })
  .when('/shop', {
      templateUrl: 'store.html',
      controller: 'storeController'
  })
}]);

// Create a controller: 
storeModule.controller('storeController', 
    function ($scope, Vat, $http) { 

        $scope.addToBasket = function (item_id, name, price, image) {
           if (typeof(Storage) !== "undefined") {
              if(localStorage.getItem('cart') == null)
              {
                 var cart = {};
                 cart[item_id] = {'item_id':item_id, 'name':name, 'price':price, 'qty':1, 'image':image};
                 localStorage.setItem('cart', JSON.stringify(cart));
             }
             else {
                 var cart = JSON.parse(localStorage.getItem('cart'));

                if(typeof(cart[item_id]) == 'undefined') {
                //if (window['varname'] != void 0) old browsers ??
                    cart[item_id] = {'item_id':item_id, 'name':name, 'price':price, 'qty':1, 'image':image};
                }
                else {
                    cart[item_id].qty++;
                }
                localStorage.setItem('cart', JSON.stringify(cart));
            }
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


// Create a controller: 
storeModule.controller('cartController', 
    function ($scope, Vat, $http) { 
    $scope.cart =  JSON.parse(localStorage.getItem('cart'));

    $scope.total = function(total) {
       var total = 0;
       var len  = objectLength($scope.cart);

       for (var key in $scope.cart) {
           total = total + ($scope.cart[key].qty * $scope.cart[key].price);
        }   
       return total;
    }

    $scope.removeFromBasket = function (item_id) {
      console.log($scope.cart);
        for (var key in $scope.cart) {

          if ($scope.cart[key].item_id == item_id)
          {
            delete $scope.cart[key]
          }

        }
        localStorage.setItem('cart', JSON.stringify($scope.cart));
    };

});

function objectLength(obj) {

    var count = 0;
    var i;

    for (i in obj) {
        if (obj.hasOwnProperty(i)) {
            count++;
        }
    }
    return count;

}