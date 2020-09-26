app.controller('createUser',['$scope','$http',function($scope,$http,$routeParams){
  $scope.alerts = [];
  $scope.editAcept = 0;
  $scope.user={
    name:"",
    lastname:""
  };
  //$scope.ID = $routeParams.ID;
  //$scope.start=0;


  $scope.insert=function(){
    console.log($scope.user.lastname);
    $http.post("../api/user_crud.php", {
      'activity':'insert',
      'user_name':$scope.user.name,
      'user_last':$scope.user.lastname
    }).then(function(response){
      console.log("Data Inserted Successfully");
      alert('usuario insertado');
      window.history.back();
    },function(error){
      alert("Sorry! Data Couldn't be inserted!");
      console.error(error);
    });
  };


}]);
