app.controller('mvc-controller',function($scope,$http,DTOptionsBuilder){
  $scope.alerts = [];
  $scope.addCard=false;
  $scope.editCard=false;
  $scope.mdVwCtl={};
  $scope.dtInstance = {};
  $scope.dtOptions= DTOptionsBuilder.newOptions()
  .withLanguageSource('Spanish.json')
  .withOption('stateSave', true);

  $scope.insert=function(){
    console.log($scope.mdVwCtl);
    $http.post("../api/mvc_crud.php", {
      'activity':'insert',
      'mvc_name':$scope.mdVwCtl.Name,
      'mvc_parent':$scope.mdVwCtl.parent,
      'mvc_view':$scope.mdVwCtl.view,
      'mvc_class':$scope.mdVwCtl.class,
      'mvc_roll':$scope.mdVwCtl.roll,
      'mvc_icon':$scope.mdVwCtl.icon,
      'mvc_order':$scope.mdVwCtl.order
    }).then(function(response){
      console.log(response);
      console.log("Data Inserted Successfully");
      $scope.getRegisters();
    },function(error){
      alert("Sorry! Data Couldn't be inserted!");
      console.error(error);
    });
    $scope.getRegisters();
  };
  $scope.delete=function(mdVwCtlId){
    if (confirm("Confirmar Eliminar.")) {
       $http.post("../api/mvc_crud.php", {
                  'activity':'delete',
                  'mvc_id':mdVwCtlId
              }).then(function(response){
                      console.log("Data Inserted Successfully");
                      $scope.getRegisters();
                      $scope.alert('Elemento eliminado');
                  },function(error){
                      alert("Sorry! Data Couldn't be inserted!");
                      console.error(error);
                  });
    $scope.getRegisters();
    }
  };
  $scope.alert=function(string) {
    $scope.alerts.push({msg: string});
    window.setTimeout(function () {
      $scope.alerts.splice(-1,1);
    },80);
  };

  $scope.edit=function(editElement){
    console.log(editElement.mvc_name);
    $scope.editCard=1;
    $scope.mdVwCtl=editElement;
    $scope.mdVwCtl.Name=editElement.mvc_name;
    $scope.mdVwCtl.parent=editElement.mvc_parent;
    $scope.mdVwCtl.view=editElement.mvc_view;
    $scope.mdVwCtl.class=editElement.mvc_class;
    $scope.mdVwCtl.roll=editElement.mvc_roll;
    $scope.mdVwCtl.icon=editElement.mvc_icon;
    $scope.mdVwCtl.order=editElement.mvc_order;


  };
  $scope.add=function(){
    //console.log(editElement.mvc_name);
    $scope.addCard=1;
    $scope.mdVwCtl.Name='';
    $scope.mdVwCtl.parent='';
    $scope.mdVwCtl.view='';
    $scope.mdVwCtl.class='';
    $scope.mdVwCtl.roll='';
    $scope.mdVwCtl.icon='';
    $scope.mdVwCtl.order='';
  };
  $scope.cancelAdd=function(){
    $scope.addCard=0;
    $scope.mdVwCtl.Name='';
    $scope.mdVwCtl.parent='';
    $scope.mdVwCtl.view='';
    $scope.mdVwCtl.class='';
    $scope.mdVwCtl.roll='';
    $scope.mdVwCtl.icon='';
    $scope.mdVwCtl.order='';
  };

  $scope.editRegister=function(){
    console.log('hola');
    console.log($scope.mdVwCtl);
    $http.post("../api/mvc_crud.php", {
                'activity':'update',
                'mvc_id':$scope.mdVwCtl.mvc_id,
                'mvc_name':$scope.mdVwCtl.Name,
                'mvc_parent':$scope.mdVwCtl.parent,
                'mvc_view':$scope.mdVwCtl.view,
                'mvc_class':$scope.mdVwCtl.class,
                'mvc_roll':$scope.mdVwCtl.roll,
                'mvc_icon':$scope.mdVwCtl.icon,
                'mvc_order':$scope.mdVwCtl.order
            }).then(function(response){
                    console.log("Data Inserted Successfully");
                    //$scope.cancelEdit();
                    $scope.alert('Elemento editado');
                    //$scope.editCard=0;
                    $scope.getRegisters();
            },function(error){
                    alert("Sorry! Data Couldn't be inserted!");
                    console.error(error);

            });
            //$scope.getRegisters();

  };
  $scope.cancelEdit=function(){
    $scope.editCard=0;
    $scope.mdVwCtl.Name='';
    $scope.mdVwCtl.parent='';
    $scope.mdVwCtl.view='';
    $scope.mdVwCtl.class='';
    $scope.mdVwCtl.roll='';
    $scope.mdVwCtl.icon='';
    $scope.mdVwCtl.order='';
  };
  $scope.view=function(){
    console.log('si estoy aqui');
    $http.post("../api/mvc_crud.php", {
                'mvc_name':$scope.mdVwCtl.firstName,
                'mvc_last':$scope.mdVwCtl.lastName
            }).then(function(response){
                    console.log("Data Inserted Successfully");
                    $scope.getUs();
                },function(error){
                    alert("Sorry! Data Couldn't be inserted!");
                    console.error(error);

                });

  };
  $scope.getRegisters=function(){
    $http.get("../api/mvc_crud.php").then(function (response) {
      $scope.mdVwCtls = response.data.records;
      console.log(response.data.records);
    });
  }
  $scope.getRegisters();
});
