app.controller('magnitudesCtl',function($scope,$http,DTOptionsBuilder,$mdDialog){
	$scope.magnitude={
		magnitude_id:0,
		magnitude_name:"",
		magnitude_description:""
	};
	$scope.dtInstance = {};
  $scope.dtOptions= DTOptionsBuilder.newOptions()
  .withLanguageSource('Spanish.json')
  .withOption('stateSave', true);

  //$scope.start=0;
	$scope.showConfirm = function(ev,id) {
	    var confirm = $mdDialog.confirm().title('¿Eliminar?')
	          .ariaLabel('Lucky day').targetEvent(ev)
	          .ok('Eliminar').cancel('Cancelar');
	    $mdDialog.show(confirm).then(function() {
				$http.post("../api/magnitudes_crud.php", {
					'activity':'delete',
					'magnitude_id':id
				}).then(function(response){
					console.log("magnitude Deleted");
					$scope.getMagnitudes();
				},function(error){
						alert("Sorry! Data Couldn't be deleted!");
						console.error(error);
				});
	    //  $scope.status = 'You decided to get rid of your debt.';
	    }, function() {
	      //$scope.status = 'You decided to keep your debt.';
	    });
	};


$scope.cancel = function() {
 $mdDialog.cancel();
};
$scope.showTabDialog = function(ev) {
  $mdDialog.show({
    controller: 'magnitudesCtl',
    templateUrl: 'views/magnitudes/magnitude_crup.html',
    parent: angular.element(document.body),
    targetEvent: ev,
    clickOutsideToClose:false,
    openFrom:'#dialog',
    closeTo:'#dialog'
  }).then(function(answer) {
    $scope.status = 'You said the information was "' + answer + '".';
		$scope.getMagnitudes();
  }, function() {
  //  $scope.status = 'You cancelled the dialog.';
  });
};
$scope.showUpdateDialog = function(ev,id) {
	var res=$scope.magnitudes.find(u=>u.magnitude_id ==id);
  $mdDialog.show({
		locals:{magnitude:res},
		controller: ['$scope', 'magnitude', function($scope, magnitude) {
	    $scope.magnitude = magnitude;
			$scope.cancel = function() {
			 $mdDialog.cancel();
			};
			$scope.saveMagnitude=function (id) {
			//	console.log("ey ypu");
			  $http.post("../api/magnitudes_crud.php", {
			    'activity':'update',
			    'magnitude_id':id,
			    'magnitude_name':$scope.magnitude.magnitude_name,
					'magnitude_description':$scope.magnitude.magnitude_description
			  }).then(function(response){
			    console.log("Data Inserted Successfully");
					$mdDialog.hide();
			  },function(error){
			    alert("Sorry! Data Couldn't be inserted!");
			    console.error(error);
			  });
			};
  	}],
    templateUrl: 'views/magnitudes/magnitude_update.html',
    parent: angular.element(document.body),
    targetEvent: ev,
    clickOutsideToClose:false,
    openFrom:'.edit',
    closeTo:'.edit'
  }).then(function(answer) {
    $scope.status = 'You said the information was "' + answer + '".';
		$scope.getMagnitudes();
  }, function() {
  //  $scope.status = 'You cancelled the dialog.';
  });
};

$scope.insert=function(){
  $http.post("../api/magnitudes_crud.php", {
    'activity':'insert',
    'magnitude_name':$scope.magnitude.magnitude_name,
    'magnitude_description':$scope.magnitude.magnitude_description
  }).then(function(response){
    console.log("Data Inserted Successfully");
		$mdDialog.hide();
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};

$scope.getMagnitudes=function(){
  $http.get("../api/magnitudes_crud.php").then(function (response) {
    //console.log(response.data);
    $scope.magnitudes = response.data.records;
  });
};
$scope.getMagnitudes();
});
