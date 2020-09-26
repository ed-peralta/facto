app.controller('viewProject',function($scope,$http,DTOptionsBuilder,$mdDialog,$routeParams){
$scope.treeOptions = {
  accept: function(sourceNodeScope, destNodesScope, destIndex) {
    return true;
  },
};

$scope.projId = $routeParams.proj;
$scope.project;
$scope.partList;
console.log($routeParams.proj);
//console.log($routeParams.node);

$scope.update=function(){
  console.log(JSON.stringify($scope.project));
  $http.post("../api/project_crud.php", {
    'activity':'update',
    'tree_id':$scope.projId,
    'project_name':$scope.project.name,
    'project_json':JSON.stringify($scope.project)
  }).then(function(response){
    console.log("Data Updated Successfully");
    if (!confirm("Proyecto actualizado.\n ¿Continuar editando?.")) {
      window.history.back();
    }
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};
$scope.refreshPlist=function (posfix) {
  console.log(posfix);
  var temp=$scope.partList.find(x => x.posfix == posfix);
  console.log(temp);
  $scope.partList=temp.chdn;
};
$scope.getProject=function(projId){
  $http.post("../api/project_crud.php", {
    'activity':'get_project',
    'tree_id':projId
  }).then(function(response){
    var temp;
    temp=response.data.records;
    $scope.project=JSON.parse(temp[0].tree_json);
    $scope.partList=$scope.project.chdn;
    $scope.specialParts=$scope.project.sprt;
    $scope.comercialParts=$scope.project.cprt;
		//console.log($scope.partList);
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};
if ($routeParams.node=="null") {
  $scope.getProject($scope.projId);
}else {
  $scope.project=JSON.parse($routeParams.node);
  //$scope.getProject($scope.projId);
}
$scope.showUpdateDialog = function(ev,id,project) {
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
	templateUrl: 'views/providers/project_addparts.html',
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

});
