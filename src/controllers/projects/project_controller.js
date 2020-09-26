app.controller('projectsCtl',function($scope,$http,DTOptionsBuilder,$mdDialog){
  $scope.dtInstance = {};
  $scope.dtOptions= DTOptionsBuilder.newOptions()
  .withLanguageSource('Spanish.json')
  .withOption('stateSave', true);
  var format = function ( d ) {
   // `d` is the original data object for the row
  if (!d) {return ''}else {
    //console.log(d);
    var res=$scope.projects.find(u=>u.tree_id == d[0]);
    console.log(res);
    //console.log(d[0]);
    var extraRow='';
    extraRow='<div class="container">'
    +'<div class="btn-group" style="display:flex;">'
    +'<a style="flex:1;" class="btn btn-info" href="#!projects/project/'+d[0]+'/null"><i class="fas fa-eye"></i> Lisras de Partes</a>'
    +'<a style="flex:1;" class="btn btn-info" href="#!projects/project_u/'+d[0]+'"><i class="fas fa-edit"></i> Editar Proyecto</a>'
	  +'<a style="flex:1;" class="btn btn-info" href="#!projects/project_import/'+d[0]+'"><i class="fas fa-sign-in-alt"></i> Importar</a>'
    +'</div></div>';
      return extraRow;
    }
}

$('body').on('click', '.details-control', function() {
   var tr = $(this).closest('tr');
   var row = $scope.dtInstance.DataTable.row( tr );
  if ( row.child.isShown() ) {
      // This row is already open - close it
    row.child.hide();
    tr.removeClass('shown');
  }
  else {
      // Open this row
    row.child( format(row.data()) ).show();
    tr.addClass('shown');
  }
});
  //$scope.start=0;

$scope.showTabDialog = function(ev) {
  $mdDialog.show({
    controller: 'usersCtl',
    templateUrl: 'views/prueba.html',
    parent: angular.element(document.body),
    targetEvent: ev,
    clickOutsideToClose:false,
    openFrom:'#dialog',
    closeTo:'#dialog'
  }).then(function(answer) {
    $scope.status = 'You said the information was "' + answer + '".';
  }, function() {
    $scope.status = 'You cancelled the dialog.';
  });
};

$scope.cancel = function() {
  $mdDialog.cancel();
};
$scope.hide = function() {
  $mdDialog.hide();
};
$scope.answer = function(answer) {
  $mdDialog.hide(answer);
};


$scope.insert=function(){
  $http.post("../api/user_crud.php", {
    'activity':'insert',
    'user_name':$scope.user.firstName,
    'user_last':$scope.user.lastName
  }).then(function(response){
    console.log("Data Inserted Successfully");
    $scope.getProjects();
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};

$scope.showConfirm = function(ev,id) {
		var confirm = $mdDialog.confirm().title('¿Eliminar?')
					.ariaLabel('Lucky day').targetEvent(ev)
					.ok('Eliminar').cancel('Cancelar');
		$mdDialog.show(confirm).then(function() {
			$http.post("../api/project_crud.php", {
				'activity':'delete',
				'tree_id':id
			}).then(function(response){
				console.log("Project Deleted");
				$scope.getProjects();
			},function(error){
					alert("Sorry! Data Couldn't be deleted!");
					console.error(error);
			});
		//  $scope.status = 'You decided to get rid of your debt.';
		}, function() {
			//$scope.status = 'You decided to keep your debt.';
		});
};
$scope.showConfirmClone = function(ev,id) {
	var res=$scope.projects.find(u=>u.tree_id==id);
	var temp=JSON.parse(res.tree_json);
	console.log(temp);
		var confirm = $mdDialog.prompt().title('¿Clonar proyecto?')
					.textContent('Asigna un nuevo nombre')
					.ariaLabel('Lucky day').targetEvent(ev)
					.ok('Clonar').cancel('Cancelar');
		$mdDialog.show(confirm).then(function(result) {
			temp.name=result;
			$http.post("../api/project_crud.php", {
				'activity':'insert',
				'project_name':result,
	      'project_json':JSON.stringify(temp)

			}).then(function(response){
				console.log("Project Deleted");
				$scope.getProjects();
			},function(error){
					alert("Sorry! Data Couldn't be deleted!");
					console.error(error);
			});
		//  $scope.status = 'You decided to get rid of your debt.';
		}, function() {
			//$scope.status = 'You decided to keep your debt.';
		});
};

$scope.getProjects=function(){
  $http.get("../api/project_crud.php").then(function (response) {
    //console.log(response.data);
    $scope.projects = response.data.records;
    //table.draw();
    //console.log($scope.projects);
  });
};
$scope.getProjects();

});
