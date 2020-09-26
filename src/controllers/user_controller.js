app.controller('usersCtl',function($scope,$http,DTOptionsBuilder,$mdDialog){
  $scope.alerts = [];
  $scope.editAcept = 0;
  $scope.user={};
  $scope.dtInstance = {};
  $scope.dtOptions= DTOptionsBuilder.newOptions()
  .withLanguageSource('Spanish.json')
  .withOption('stateSave', true);


      var format = function ( d ) {
       // `d` is the original data object for the row
      if (!d) {return ''}else {
        //console.log(d);
        var res=$scope.users.find(u=>u.user_id == d[0]);
        console.log(res);
        //console.log(d[0]);
        var extraRow='';
        extraRow='<div class="card"><div class="card-header">Quote</div>'
        +'<div class="card-body"><blockquote class="blockquote mb-0">'
        +'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>'
        +'<form><div class="form-group"><label >Nombre:'+res.user_name+'</label>'
        +'<input ng-model="user.user_name" type="text" class="form-control" placeholder="">'
        +'</div><div class="form-group"><label >Apellidos:</label>'
        +'<input ng-model="user.user_lastname" type="text" class="form-control" placeholder="">'
        +'</div><div class="form-group"><label >Email address:{{user.user_mail}}</label>'
        +'<input ng-model="user.user_mail" type="email" class="form-control" placeholder="ejemplo@rocektmail.com">'
        '</div><button type="submit" class="btn btn-danger" ng-click="cancelEdit()">Cancelar</button>'
        +'<button type="submit" class="btn btn-success" ng-click="editUser()">Guardar</button></form>'
        +'<footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite>'
        +'</footer></blockquote></div></div>';
        extraRow=extraRow+'<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
          '<tr>'+
             '<td>Full name:</td>'+
             '<td>'+d.name+'</td>'+
          '</tr>'+
          '<tr>'+
             '<td>Extension number:</td>'+
             '<td>'+d.extn+'</td>'+
          '</tr>'+
          '<tr>'+
             '<td>Extra info:</td>'+
             '<td>And any further details here (images etc)...</td>'+
           '</tr>'+
          '</table>';
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
      $scope.getUs();
    },function(error){
      alert("Sorry! Data Couldn't be inserted!");
      console.error(error);
    });
  };
  $scope.delete=function(userId){
    if (confirm("Confirmar Eliminar.")) {
    $http.post("../api/user_crud.php", {
      'activity':'delete',
      'user_id':userId
    }).then(function(response){
      console.log("Data Inserted Successfully");
      $scope.getUs();
      $scope.alert();
    },function(error){
        alert("Sorry! Data Couldn't be inserted!");
        console.error(error);
    });
  }
  };
  $scope.alert=function() {
    $scope.alerts.push({msg: 'Elemento eliminado!'});
    window.setTimeout(function () {
      $scope.alerts.splice(-1,1);
    },80);
  };
  $scope.edit=function(us){
    console.log(us.user_lastname);
    $scope.editAcept=1;
    $scope.user=us;
    $scope.user.firstName=us.user_name;
    $scope.user.lastName=us.user_lastname;
  };

  $scope.editUser=function(){
    $http.post("../api/user_crud.php", {
      'activity':'update',
      'user_id':$scope.user.user_id,
      'user_name':$scope.user.firstName,
      'user_last':$scope.user.lastName
    }).then(function(response){
      console.log("Data Inserted Successfully");
      $scope.getUs();
      $scope.editAcept=0;
    },function(error){
      alert("Sorry! Data Couldn't be inserted!");
      console.error(error);
    });
  };
  $scope.cancelEdit=function(){
    $scope.editAcept=0;
    $scope.user.firstName='';
    $scope.user.lastName='';
  };
  $scope.view=function(){
    $http.post("../api/user_crud.php", {
      'user_name':$scope.user.firstName,
      'user_last':$scope.user.lastName
    }).then(function(response){
      console.log("Data Inserted Successfully");
      $scope.getUs();
    },function(error){
      alert("Sorry! Data Couldn't be inserted!");
      console.error(error);
    });
  };

  $scope.getUs=function(){
    $http.get("../api/user_crud.php").then(function (response) {
      $scope.users = response.data.records;
      //table.draw();

    });
  };
  $scope.getUs();

});
