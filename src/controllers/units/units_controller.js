app.controller('unitsCtl',function($scope,$http,DTOptionsBuilder,$mdDialog){
$scope.dtInstance = {};
$scope.unit={
  unit_name:""
};
$scope.dtOptions= DTOptionsBuilder.newOptions()
.withLanguageSource('Spanish.json')
.withOption('stateSave', true);
$scope.showPrompt = function(ev,name,id) {
  var type;
  var confirm = $mdDialog.prompt()
    .textContent('Asignar unidad.').placeholder('KM')
    .targetEvent(ev).required(true)
    .ok('Guardar').cancel('Cancelar');
  if (name!=null || name!=undefined) {
    type="u";
    confirm.initialValue(name).title('Editar Unidad');
  }else {
    type="i";
    confirm.initialValue('').title('Crear Unidad');
  }
  $mdDialog.show(confirm).then(function(result) {
    $scope.unit.unit_name=result;
    switch (type) {
      case "u":
        $scope.saveUnit(id);
        break;
      case "i":
        $scope.insert();
        break;
      default:
    }
  }, function() {
    $scope.status = '';
  });
};
$scope.showConfirm = function(ev,id) {
    var confirm = $mdDialog.confirm().title('¿Eliminar?')
          .ariaLabel('Lucky day').targetEvent(ev)
          .ok('Eliminar').cancel('Cancelar');
    $mdDialog.show(confirm).then(function() {
			$http.post("../api/units_crud.php", {
				'activity':'delete',
				'unit_id':id
			}).then(function(response){
				console.log("Unit Deleted");
				$scope.getUnits();
			},function(error){
					alert("Sorry! Data Couldn't be deleted!");
					console.error(error);
			});
    //  $scope.status = 'You decided to get rid of your debt.';
    }, function() {
      //$scope.status = 'You decided to keep your debt.';
    });
};
$scope.insert=function(){
	console.log($scope.unit.unit_name);
  $http.post("../api/units_crud.php", {
    'activity':'insert',
    'unit_name':$scope.unit.unit_name
  }).then(function(response){
    console.log("Data Inserted Successfully");
		console.log(response);
    $scope.getUnits();
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};
$scope.saveUnit=function (id) {
  $http.post("../api/units_crud.php", {
    'activity':'update',
    'unit_id':id,
    'unit_name':$scope.unit.unit_name
  }).then(function(response){
    console.log("Data Inserted Successfully");
    $scope.getUnits();
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};
$scope.getUnits=function(){
  $http.get("../api/units_crud.php").then(function (response) {
    $scope.units = response.data.records;
  });
};
$scope.getUnits();
});
