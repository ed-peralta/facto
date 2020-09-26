app.controller('updateUser',['$scope','$http','$routeParams',function($scope,$http,$routeParams){
  $scope.alerts = [];
  $scope.editAcept = 0;

  $scope.user = JSON.parse($routeParams.Us);
  //$scope.start=0;

  console.log(typeof($scope.user));
  console.log($scope.user);
  $scope.editUser=function(){
    $http.post("../api/user_crud.php", {
      'activity':'update',
      'user_id':$scope.user.user_id,
      'user_name':$scope.user.user_name,
      'user_last':$scope.user.user_lastname,
      'user_mail':$scope.user.user_mail
    }).then(function(response){
      console.log("Data Inserted Successfully");
      alert('Usuario guardao correctamente');
      window.history.back();
    },function(error){
      alert("Sorry! Data Couldn't be inserted!");
      console.error(error);
    });
  };
  $scope.cancelEdit=function () {
    window.history.back();
  };

}]);
