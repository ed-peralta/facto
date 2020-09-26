app.controller('providersCtl',function($scope,$http,DTOptionsBuilder,$mdDialog){
	$scope.provider={
		provider_id:0,
		provider_name:"",
		provider_address:"",
		provider_vat:"",
		provider_contact:"",
		provider_phone:"",
		provider_mail:"",
		provider_count:"",
		provider_bank:"",
		provider_percentaje:""
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
				$http.post("../api/providers_crud.php", {
					'activity':'delete',
					'provider_id':id
				}).then(function(response){
					console.log("provider Deleted");
					$scope.getProviders();
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
		controller: 'providersCtl',
		templateUrl: 'views/providers/provider_create.html',
		parent: angular.element(document.body),
		targetEvent: ev,
		clickOutsideToClose:false,
		openFrom:'#dialog',
		closeTo:'#dialog'
	}).then(function(answer) {
		//$scope.status = 'You said the information was "' + answer + '".';
		$scope.getProviders();
	}, function() {
	//  $scope.status = 'You cancelled the dialog.';
	});
	};
	$scope.showUpdateDialog = function(ev,id) {
	var res=$scope.providers.find(u=>u.provider_id ==id);
	$mdDialog.show({
		locals:{provider:res},
		controller: ['$scope', 'provider', function($scope, provider) {
			$scope.provider = provider;
			$scope.cancel = function() {
			 $mdDialog.cancel();
			};
			$scope.saveProvider=function (id) {
			//	console.log("ey ypu");
				$http.post("../api/providers_crud.php", {
					'activity':'update',
					'provider_id':id,
					'provider_name'	 		 :$scope.provider.provider_name,
					'provider_address'	 :$scope.provider.provider_address,
					'provider_vat'			 :$scope.provider.provider_vat,
					'provider_contact'	 :$scope.provider.provider_contact,
					'provider_phone'		 :$scope.provider.provider_phone,
					'provider_mail'			 :$scope.provider.provider_mail,
					'provider_count'		 :$scope.provider.provider_count,
					'provider_bank'			 :$scope.provider.provider_bank,
					'provider_percentaje':$scope.provider.provider_percentaje
				}).then(function(response){
					console.log("Data Inserted Successfully");
					$mdDialog.hide();
				},function(error){
					alert("Sorry! Data Couldn't be inserted!");
					console.error(error);
				});
			};
		}],
		templateUrl: 'views/providers/provider_update.html',
		parent: angular.element(document.body),
		targetEvent: ev,
		clickOutsideToClose:false,
		openFrom:'.edit',
		closeTo:'.edit'
	}).then(function(answer) {
		//$scope.status = 'You said the information was "' + answer + '".';
		$scope.getProviders();
	}, function() {
	//  $scope.status = 'You cancelled the dialog.';
	});
	};

	$scope.insert=function(){
	$http.post("../api/providers_crud.php", {
		'activity':'insert',
		'provider_name'	 		 :$scope.provider.provider_name,
		'provider_address'	 :$scope.provider.provider_address,
		'provider_vat'			 :$scope.provider.provider_vat,
		'provider_contact'	 :$scope.provider.provider_contact,
		'provider_phone'		 :$scope.provider.provider_phone,
		'provider_mail'			 :$scope.provider.provider_mail,
		'provider_count'		 :$scope.provider.provider_count,
		'provider_bank'			 :$scope.provider.provider_bank,
		'provider_percentaje':$scope.provider.provider_percentaje
	}).then(function(response){
		console.log("Data Inserted Successfully");
		$mdDialog.hide();
	},function(error){
		alert("Sorry! Data Couldn't be inserted!");
		console.error(error);
	});
	};

$scope.getProviders=function(){
  $http.get("../api/providers_crud.php").then(function (response) {
    $scope.providers = response.data.records;
  });
};
$scope.getProviders();
});
