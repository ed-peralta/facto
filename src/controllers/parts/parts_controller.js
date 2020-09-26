app.controller('partsCtl',function($scope,$http,DTOptionsBuilder,$mdDialog){
  $scope.dtInstance = {};
  $scope.dtOptions= DTOptionsBuilder.newOptions()
  .withLanguageSource('Spanish.json')
	.withOption('responsive', true).withOption('stateSave', true);
  //$scope.start=0;
	var format = function ( d ) {
	if (!d) {return ''}else {
		var res=$scope.parts.find(u=>u.part_id == d[0]);
		var extraRow='';
		extraRow='<div class="row">'
			+'<div class="col-md-4">'
			+'<img src="data:'+res.image_mime+';base64,'+res.image_data+'" width="auto" height="200px" />'
			+'</div>'
			+'<div class="col-md-4">'
			+'<h5 style="color:gray;">Descripción:</h5> <h6 style="padding-left:1em;">'+res.part_description+'</h6>'
			+'<h5 style="color:gray;">Fabricante:</h5><h6 style="padding-left:1em;">'+res.part_manufacturer+'</h6>'
			+'<h5 style="color:gray;">Proveedor:</h5><h6 style="padding-left:1em;">'+res.part_provider+'</h6>'
			+'</div>'
			+'<div class="col-md-4">'
			+'<h5 style="color:gray;">No. Parte Fabricante:</h5><h6 style="padding-left:1em;">'+res.part_number_manufacturer+'</h6>'
			+'<h5 style="color:gray;">No. Parte Proveedor:</h5><h6 style="padding-left:1em;">'+res.part_number_provider+'</h6>'
			+'<h5 style="color:gray;">Precio:</h5><h6 style="padding-left:1em;">'+parseFloat(res.part_price).toFixed(2)+' '+res.part_coin+' P/'+res.part_unit+'</h6>'

			+'</div></div>';
			return extraRow;
		}
	}

$('body').on('mouseover', '.details-control', function() {
  var tr = $(this).closest('tr');
  var row = $scope.dtInstance.DataTable.row( tr );
  row.child( format(row.data()) ).show();
  tr.addClass('shown');
});
$('body').on('mouseleave', '.details-control', function() {
  var tr = $(this).closest('tr');
  var row = $scope.dtInstance.DataTable.row( tr );
  row.child.hide();
  tr.removeClass('shown');
});

$scope.showPrompt = function(ev,part) {
  var confirm = $mdDialog.prompt().title('Actualizar Precio')
    .textContent('Ingresar cantidad.').placeholder('22.02')
    .targetEvent(ev).required(true).initialValue(part.part_price)
    .ok('Guardar').cancel('Cancelar');
    $mdDialog.show(confirm).then(function(result) {
      $http.post("../api/parts_crud.php", {
        'activity':'updatePrice',
        'part_id':part.part_id,
        'part_price':result
      }).then(function(response){
        $scope.getParts();
        console.log("Data Inserted Successfully");
        $mdDialog.hide();

      },function(error){
        alert("Sorry! Data Couldn't be inserted!");
        console.error(error);
      });
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
$scope.showTabDialog = function(ev,id) {
  var res=$scope.parts.find(u=>u.part_id ==id);
  $mdDialog.show({
		locals:{part:res},
		controller: ['$scope', 'part', function($scope, part) {
			$scope.part = part;
			$scope.cancel = function() {
			 $mdDialog.cancel();
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
				});

      };
      $scope.getSelects();
			$scope.save=function (id) {
			//	console.log("ey ypu");
				$http.post("../api/parts_crud.php", {
					'activity':'update',
					'part_id':id,
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
					console.log("Data Inserted Successfully");
					$mdDialog.hide();
				},function(error){
					alert("Sorry! Data Couldn't be inserted!");
					console.error(error);
				});
			};
		}],
		templateUrl: 'views/parts/part_u.html',
		parent: angular.element(document.body),
		targetEvent: ev,
		clickOutsideToClose:false,
		openFrom:'.edit',
		closeTo:'.edit'
  });
};

$scope.getParts=function(){
  $http.get("../api/parts_crud.php").then(function (response) {
    $scope.parts = response.data.records;
  });
};
$scope.getParts();
//$scope.parts=[];
});
