app.controller('detailsProspectController',['$scope','$http','$routeParams',function($scope,$http,$routeParams){
    $scope.prospect_id=$routeParams.prospect;
    console.log($scope.prospect_id);
    $scope.edit=false;
    $scope.temporal_son={
      name:"",
      lastname_materno:"",
      lastname_paterno:"",
      mail:"",
      phone:"",
      birthday:new Date()
    };
    $scope.temporal_reference={
      name:"",
      lastname_materno:"",
      lastname_paterno:"",
      mail:"",
      phone:"",
      birthday:new Date()
    };
    //$scope.ID = $routeParams.ID;
    //$scope.start=0;
    
    $scope.addSon = function() {
      console.log($scope.prospect);
      
      $scope.prospect.sons.push({
        name:$scope.temporal_son.name,
        lastname_materno:$scope.temporal_son.lastname_paterno,
        lastname_paterno:$scope.temporal_son.lastname_materno,
        mail:$scope.temporal_son.mail,
        phone:$scope.temporal_son.phone
      });
      
    };
    $scope.addReference = function() {
      console.log($scope.prospect);
      
      $scope.prospect.references.push({
        name:$scope.temporal_reference.name,
        lastname_materno:$scope.temporal_reference.lastname_paterno,
        lastname_paterno:$scope.temporal_reference.lastname_paterno,
        mail:$scope.temporal_reference.mail,
        phone:$scope.temporal_reference.phone
      });
      
    };
    $scope.update=function(){
      console.log($scope.prospect);
      $http.post("../api/prospects_crud_beta.php", {
        'activity':'update',
        'prospect':JSON.stringify($scope.prospect),
        'prospect_id': $scope.prospect_id
      }).then(function(response){
        console.log(response);
        //alert('prospecto insertado');
       // window.history.back();
      },function(error){
        alert("Sorry! Data Couldn't be inserted!");
        console.error(error);
      });
    };
    $scope.getprospect=function(){
        $http.post("../api/prospects_crud_beta.php",{
            'activity':'get_prospect',
            'prospect_id': $scope.prospect_id
        }).then(function (response) {
          console.log(response);
          $scope.prospect =JSON.parse( response.data.records.person_data);
            console.log(response);
            console.log($scope.prospect);
        });
        
    };
    $scope.getprospect();
  
  }]);
  