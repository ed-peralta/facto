app.controller('manufacturersCtl',function($scope,$http,DTOptionsBuilder,$mdDialog){
  $scope.dtInstance = {};
  $scope.dtOptions= DTOptionsBuilder.newOptions()
  .withLanguageSource('Spanish.json')
  .withOption('stateSave', true);
	$scope.manufacturer={
	  manufacturer_name:""
	};

	$scope.showPrompt = function(ev,name,id) {
	  var type;
	  var confirm = $mdDialog.prompt()
	    .textContent('Asignar nombre.').placeholder('EL DEL TORNILLO')
	    .targetEvent(ev).required(true)
	    .ok('Guardar').cancel('Cancelar');
	  if (name!=null || name!=undefined) {
	    type="u";
	    confirm.initialValue(name).title('Editar Fabricante');
	  }else {
	    type="i";
	    confirm.initialValue('').title('Crear Fabricante');
	  }
	  $mdDialog.show(confirm).then(function(result) {
	    $scope.manufacturer.manufacturer_name=result;
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
	    // Appending dialog to document.body to cover sidenav in docs app
	    var confirm = $mdDialog.confirm().title('¿Eliminar?')
	          .ariaLabel('Lucky day').targetEvent(ev)
	          .ok('Eliminar').cancel('Cancelar');

	    $mdDialog.show(confirm).then(function() {
				$http.post("../api/manufacturers_crud.php", {
					'activity':'delete',
					'manufacturer_id':id
				}).then(function(response){
					console.log("Manufacturer Deleted");
					$scope.getManufacturers();
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
  $http.post("../api/manufacturers_crud.php", {
    'activity':'insert',
    'manufacturer_name':$scope.manufacturer.manufacturer_name
  }).then(function(response){
    console.log("Data Inserted Successfully");
    $scope.getManufacturers();
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};
$scope.saveUnit=function (id) {
  $http.post("../api/manufacturers_crud.php", {
    'activity':'update',
    'manufacturer_id':id,
		'manufacturer_name':$scope.manufacturer.manufacturer_name
  }).then(function(response){
    console.log("Data Inserted Successfully");
    $scope.getManufacturers();
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};

$scope.getManufacturers=function(){
  $http.get("../api/manufacturers_crud.php").then(function (response) {
    console.log(response.data);
    $scope.manufacturers = response.data.records;
    //table.draw();
    //console.log($scope.projects);
  });
};
$scope.getManufacturers();
//$scope.Manufacturers=[];
});
