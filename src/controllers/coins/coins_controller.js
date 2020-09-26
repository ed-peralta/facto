app.controller('coinsCtl',function($scope,$http,DTOptionsBuilder,$mdDialog){
	$scope.dtInstance = {};
	$scope.dtOptions= DTOptionsBuilder.newOptions()
	.withLanguageSource('Spanish.json')
	.withOption('stateSave', true);

	//$scope.start=0;
	$scope.showConfirm = function(ev) {
			var confirm = $mdDialog.confirm().title('¿Actualizar todas las monedas?')
						.ariaLabel('Lucky day').targetEvent(ev)
						.ok('Actualizar').cancel('Cancelar');
			$mdDialog.show(confirm).then(function() {
				$http.post("../api/coins_crud.php", {
					'activity':'update'
				}).then(function(response){
					console.log("actualizado");
					$scope.getCoins();
				},function(error){
						alert("Sorry! Data Couldn't be deleted!");
						console.error(error);
				});
			//  $scope.status = 'You decided to get rid of your debt.';
			}, function() {
				//$scope.status = 'You decided to keep your debt.';
			});
	};

$scope.getCoins=function(){
  $http.get("../api/coins_crud.php").then(function (response) {
    $scope.coins = response.data.records;
		console.log($scope.coins);
  });

};
$scope.getCoins();
});
