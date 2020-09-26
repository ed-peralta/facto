app.controller('prospectsCtl',function($scope,$http,DTOptionsBuilder,$mdDialog){
	$scope.prospect={
		prospect_id:0,
		prospect_name:"",
		prospect_address:"",
		prospect_phone:"",
		prospect_mail:""
	};
	$scope.dtInstance = {};
	$scope.dtOptions= DTOptionsBuilder.newOptions()
	.withLanguageSource('Spanish.json')
	.withOption('stateSave', true)
	.withOption('responsive', true);

	//$scope.start=0;
	$scope.showConfirm = function(ev,id) {
			var confirm = $mdDialog.confirm().title('¿Eliminar?')
						.ariaLabel('Lucky day').targetEvent(ev)
						.ok('Eliminar').cancel('Cancelar');
			$mdDialog.show(confirm).then(function() {
				$http.post("../api/prospects_crud.php", {
					'activity':'delete',
					'prospect_id':id
				}).then(function(response){
					console.log("prospect Deleted");
					$scope.getprospects();
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
		controller: 'prospectsCtl',
		templateUrl: 'views/prospects/prospect_create.html',
		parent: angular.element(document.body),
		targetEvent: ev,
		clickOutsideToClose:false,
		openFrom:'#dialog',
		closeTo:'#dialog'
	}).then(function(answer) {
		//$scope.status = 'You said the information was "' + answer + '".';
		$scope.getprospects();
	}, function() {
	//  $scope.status = 'You cancelled the dialog.';
	});
	};
	$scope.showUpdateDialog = function(ev,id) {
	var res=$scope.prospects.find(u=>u.prospect_id ==id);
	$mdDialog.show({
		locals:{prospect:res},
		controller: ['$scope', 'prospect', function($scope, prospect) {
			$scope.prospect = prospect;
			$scope.cancel = function() {
			 $mdDialog.cancel();
			};
			$scope.saveprospect=function (id) {
			//	console.log("ey ypu");
				$http.post("../api/prospects_crud.php", {
					'activity':'update',
					'prospect_id':id,
					'prospect_name'	 		 :$scope.prospect.prospect_name,
					'prospect_address'	 :$scope.prospect.prospect_address,
					'prospect_vat'			 :$scope.prospect.prospect_vat,
					'prospect_contact'	 :$scope.prospect.prospect_contact,
					'prospect_phone'		 :$scope.prospect.prospect_phone,
					'prospect_mail'			 :$scope.prospect.prospect_mail,
					'prospect_count'		 :$scope.prospect.prospect_count,
					'prospect_bank'			 :$scope.prospect.prospect_bank,
					'prospect_percentaje':$scope.prospect.prospect_percentaje
				}).then(function(response){
					console.log("Data Inserted Successfully");
					$mdDialog.hide();
				},function(error){
					alert("Sorry! Data Couldn't be inserted!");
					console.error(error);
				});
			};
		}],
		templateUrl: 'views/prospects/prospect_update.html',
		parent: angular.element(document.body),
		targetEvent: ev,
		clickOutsideToClose:false,
		openFrom:'.edit',
		closeTo:'.edit'
	}).then(function(answer) {
		//$scope.status = 'You said the information was "' + answer + '".';
		$scope.getprospects();
	}, function() {
	//  $scope.status = 'You cancelled the dialog.';
	});
	};

	$scope.insert=function(){
	$http.post("../api/prospects_crud.php", {
		'activity':'insert',
		'prospect_name'	 		 :$scope.prospect.prospect_name,
		'prospect_address'	 :$scope.prospect.prospect_address,
		'prospect_vat'			 :$scope.prospect.prospect_vat,
		'prospect_contact'	 :$scope.prospect.prospect_contact,
		'prospect_phone'		 :$scope.prospect.prospect_phone,
		'prospect_mail'			 :$scope.prospect.prospect_mail,
		'prospect_count'		 :$scope.prospect.prospect_count,
		'prospect_bank'			 :$scope.prospect.prospect_bank,
		'prospect_percentaje':$scope.prospect.prospect_percentaje
	}).then(function(response){
		console.log("Data Inserted Successfully");
		$mdDialog.hide();
	},function(error){
		alert("Sorry! Data Couldn't be inserted!");
		console.error(error);
	});
	};

$scope.getprospects=function(){
  $http.get("../api/prospects_crud_beta.php").then(function (response) {
	$scope.prospects = response.data.records;
	console.log($scope.prospects);
  });
};
$scope.getprospects();
});
