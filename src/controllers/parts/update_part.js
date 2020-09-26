app.controller('updatePart',function($scope,$http,$mdDialog){
$scope.part;

$scope.insertPart=function () {
  console.log($scope.part);
  $http.post("../api/parts_crud.php", {
    'activity':'insert',
    'part_description':$scope.part.part_description,
    'part_unit':$scope.part.part_unit,
    'part_coin':$scope.part.part_coin,
    'part_price':$scope.part.part_price,
    'part_value':$scope.part.part_value,
    'part_magnitude':$scope.part.part_magnitude,
    'part_manufacturer':$scope.part.part_manufacturer,
    'part_provider':$scope.part.part_provider,
    'part_number_manufacturer':$scope.part.part_number_manufacturer,
    'part_number_provider':$scope.part.part_number_provider

  }).then(function(response){
    console.log(response);
    alert('Parte insertada');
    //window.history.back();
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};
$scope.cancelEdit=function () {
  window.history.back();
};

$scope.getParts=function(){
  $http.get("../api/parts_crud.php").then(function (response) {
    $scope.parts = response.data.records;
  });
};
$scope.getSelects=function(){
  $http.get("../api/magnitudes_crud.php").then(function (response) {
    $scope.magnitudes = response.data.records;
  });
	$http.get("../api/units_crud.php").then(function (response) {
    $scope.units = response.data.records;
  });
	$http.get("../api/manufacturers_crud.php").then(function (response) {
    $scope.manufacturers = response.data.records;
  });
	$http.get("../api/providers_crud.php").then(function (response) {
    $scope.providers = response.data.records;
  });
	$http.get("../api/coins_crud.php").then(function (response) {
    $scope.coins = response.data.records;
		console.log($scope.coins);
  });

};
$scope.getSelects();
$scope.getParts();
//$scope.parts=[];
});
