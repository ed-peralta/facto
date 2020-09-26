<script src="js/jquery-3.3.1.slim.min.js" ></script>
<script src="js/popper.min.js" ></script>
<script src="js/bootstrap.js"></script>

<script src="js/dataTables.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/ng-breadcrumbs.js"></script>
<script src="js/angular-datatables.js"></script>
<script src="js/angular-ui-tree.js"></script>

<script src="js/angular-route.js"></script>
<script src="js/angular-animate.js"></script>
<script src="js/angular-aria.js"></script>
<script src="js/angular-messages.js"></script>
<script src="js/angular-material.js"></script>
<!-- Angular Material Library
<script src="js/angular-material.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.js"></script>
-->
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
var app = angular.module('Facto', ["ngRoute","datatables","ng-breadcrumbs","ngMaterial","ngMessages","ui.tree"]);
app.config(function($routeProvider) {
  $routeProvider
  .when("/mvcs",{
    templateUrl : "views/mvc.html",
    label:"modelos-vistas"
  })
  .when("/users",{
    templateUrl : "views/users.html",
    controller:'usersCtl',
    label:"Usuarios"
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
    templateUrl : "views/proob.html",
    label:"Inicio"
  })
  .when("/config", {
    templateUrl : "views/config.html"
  })
  .when("/prospects",{
    templateUrl : "views/prospects/prospects.html",
    controller:'prospectsCtl',
    label:"Prospectos"
  })
  .when("/prospects/prospect_create",{
    templateUrl : "views/prospects/prospects_c.html",
    controller:'createProspect',
    label:"Crear prospecto"
  })
  .when("/prospects/prospect_detail/:prospect",{
    templateUrl : "views/prospects/prospect_detail.html",
    controller:'detailsProspectController',
    label:"Detalles del prospecto"
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
  $scope.currentUser;
  $scope.getMvc=function(){
    $http.get("../api/mvc_r.php").then(function (response) {
      $scope.modules = response.data.records;
      $scope.mod=[];
      $scope.dropD=[];
      $scope.menuEl=[];
      $scope.modules.forEach(function (el) {
        if($scope.currentUser.user_level<=el.mvc_roll){
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
      //console.log(response);
      if (!response.authenticated) {
        console.log("salir");
        $window.location.href = 'index.php';
      }
      
      $scope.currentUser=response.user;
      //console.log($scope.currentUser);
      
    });
  };
  $scope.confirmAuth();
  $scope.getMvc();
  
});
</script>
<!--
<script src="controllers/parts/create_part.js"></script>-->
<script src="controllers/prospects/details_prospect_controller.js"></script>
<script src="controllers/prospects/prospects_controller.js"></script>
<script src="controllers/prospects/create_prospect_controller.js"></script>
<script src="controllers/user_controller.js"></script>
<script src="controllers/create_user.js"></script>
<script src="controllers/mvc_controller.js"></script>
<script src="controllers/update_user.js"></script>
