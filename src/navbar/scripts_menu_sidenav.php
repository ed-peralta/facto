<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="js/angular-datatables.js"></script>
<script src="js/ng-breadcrumbs.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-messages.min.js"></script>
<!-- Angular Material Library -->
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.js"></script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

containsObject=function (obj, list) {
    var i;
    for (i = 0; i < list.length; i++) {
        console.log(list[i]);
        if (list[i] === obj) {
            return true;
        }
    }
    return false;
};
var app = angular.module('Facto', ["ngRoute","datatables","ng-breadcrumbs","ngMaterial"]);
app.config(function($routeProvider) {
  $routeProvider
  .when("/users",{
    templateUrl : "views/users.html",
    controller:'usersCtl',
    label:"Usuarios"
  })
  .when("/mvcs",{
    templateUrl : "views/mvc.html",
    label:"modelos-vistas"
  })
  .when("/users/user_c/",{
    templateUrl : "views/user_c.html",
    controller :'createUser',
    label:"Crear usuario"
  })
  .when("/users/user_u/:Us",{
    templateUrl : "views/user_u.html",
    controller :'updateUser',
    label: "Actualizar Usuario"
  })
  .when("/",{
    templateUrl : "views/proob.html"
  })
  .when("/config", {
    templateUrl : "views/config.html"
  })
  .when("/proob", {
    templateUrl : "views/proob.html"
  }).otherwise({
    redirectTo: '/'
  });
});

app.factory("authen",function ($http) {
  return {
    getAuthenticate:function () {
    return $http.get("authenticate.php").then(function (response) {
        return response.data;        //this.user=response.data.records;
      });
    }
  };
});

app.controller('myCtrl', function($scope,$http,authen,breadcrumbs,$window,$mdSidenav) {
  $scope.pageTitle="Inicio";
  $scope.breadC=[{mvc_name:'Inicio'}];
  $scope.breadcrumbs = breadcrumbs;
  $scope.getMvc=function(){
    $http.get("../api/mvc_r.php").then(function (response) {
      $scope.modules = response.data.records;
      $scope.mod=[];
      $scope.dropD=[];
      $scope.menuEl=[];
      $scope.modules.forEach(function (el) {
        switch (el.mvc_class) {
          case 'menu':
            var temp =[];
            response.data.records.forEach(function (element) {
              if(el.mvc_id==element.mvc_parent){
                temp.push(element);
              }
            });
            el.children=temp;
            $scope.dropD.push(el);
            break;
          case 'main':
            $scope.mod.push(el);
            break;
          default:
        }
      });
    //  console.log(response.data.records);
    });
  };
  $scope.toggleSidenav = buildToggler('closeEventsDisabled');

    function buildToggler(componentId) {
      return function() {
        $mdSidenav(componentId).toggle();
      };
    }


  $scope.setModule=function(module){
    $scope.pageTitle=module.mvc_name;
      //breadCservice.addBreadcrumb(module);
    //  $scope.breadC=breadCservice.getBreadcrumb();

  };
  $scope.confirmAuth=function(){
    authen.getAuthenticate().then(function (response) {
      if (!response.auth) {
        console.log("salir");
        $window.location.href = 'index.php';
      }
    });
  };
  $scope.getMvc();
  $scope.confirmAuth();
});

</script>
<script src="controllers/user_controller.js"></script>
<script src="controllers/create_user.js"></script>
<script src="controllers/mvc_controller.js"></script>
<script src="controllers/update_user.js"></script>
