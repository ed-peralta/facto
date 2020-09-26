app.controller('createProspect',['$scope','$http','$mdDialog',function($scope,$http,$mdDialog){
  $scope.alerts = [];
  $scope.editAcept = 0;
  $scope.myDate;
    

  $scope.prospect={
    name:"",
    lastname_materno:"",
    lastname_paterno:"",
    mail:"",
    phone:"",
    investment:"",
    birthday:new Date(),
    ocupation:"",
    is_father:false,
    civil_state:false,
    spouse:{
      name:"",
      lastname_materno:"",
      lastname_paterno:"",
      mail:"",
      phone:"",
      birthday:new Date()
    },
    retirement:false,
    education:false,
    temporary:false,
    orvi:false,
    health_data:{
      smoker:false,
      asma:false,
      motociclismo:false,
      diabetes:false,
      hipertencion:false,
      tiroides:false
    },
    notes:"",
    sons:[],
    references:[]
  };
  $scope.temporal_person;
  
  $scope.temporal_son={
    name:"",
    lastname_materno:"",
    lastname_paterno:"",
    mail:"",
    phone:"",
    birthday:new Date()
  };
  $scope.temporal_reference={
    name:"",
    lastname_materno:"",
    lastname_paterno:"",
    mail:"",
    phone:"",
    birthday:new Date()
  };
  //$scope.ID = $routeParams.ID;
    //$scope.start=0;
  
  $scope.insert = function(ev) {
    var confirm = $mdDialog.confirm().title('¿Crear prospecto?')
          .ariaLabel('Lucky day').targetEvent(ev)
          .ok('Crear').cancel('Cancelar');
    $mdDialog.show(confirm).then(function() {
      $scope.temporal_person.name=$scope.prospect.spouse.name;
      $scope.temporal_person.lastname_paterno=$scope.prospect.spouse.lastname_paterno;
      $scope.temporal_person.lastname_materno=$scope.prospect.spouse.lastname_materno;
      $scope.temporal_person.mail=$scope.prospect.spouse.mail;
      $scope.temporal_person.phone=$scope.prospect.spouse.phone;
      $scope.temporal_person.birthday=$scope.prospect.spouse.birthday;

      $scope.prospect.spouse=$scope.temporal_person;   
      $http.post("../api/prospects_crud_beta.php", {
        'activity':'insert',
        'prospect':angular.toJson($scope.prospect),
      }).then(function(response){
        console.log(response);
        // alert('prospecto insertado');
      	window.history.back();
      },function(error){
          alert("Hubo un problema con el alta!");
          console.error(error);
      });
    //  $scope.status = 'You decided to get rid of your debt.';
    }, function() {
      //$scope.status = 'You decided to keep your debt.';
    });
	};
  $scope.newPerson= function () {
    $http.get('controllers/prospects/person.json').then(function(response) {
      $scope.temporal_person= response.data;
   });
  };
  $scope.newPerson();
	$scope.cancel = function() {
	  $mdDialog.cancel();
	};
  $scope.addSon = function() { 
    $scope.temporal_person.name=$scope.temporal_son.name;
    $scope.temporal_person.lastname_paterno=$scope.temporal_son.lastname_paterno;
    $scope.temporal_person.lastname_materno=$scope.temporal_son.lastname_materno;
    $scope.temporal_person.mail=$scope.temporal_son.mail;
    $scope.temporal_person.phone=$scope.temporal_son.phone;
    $scope.temporal_person.birthday=$scope.temporal_son.birthday;

    $scope.prospect.sons.push($scope.temporal_person);

    $scope.temporal_son.name="";
    $scope.temporal_son.lastname_materno="";
    $scope.temporal_son.lastname_paterno="";
    $scope.temporal_son.mail="";
    $scope.temporal_son.phone="";
    $scope.temporal_son.birthday=new Date();
    $scope.newPerson();
    console.log($scope.prospect.sons);

  };
  $scope.addReference = function() {
    $scope.temporal_person.name=$scope.temporal_reference.name;
    $scope.temporal_person.lastname_paterno=$scope.temporal_reference.lastname_paterno;
    $scope.temporal_person.lastname_materno=$scope.temporal_reference.lastname_materno;
    $scope.temporal_person.mail=$scope.temporal_reference.mail;
    $scope.temporal_person.phone=$scope.temporal_reference.phone;
    $scope.temporal_person.birthday=$scope.temporal_reference.birthday;

    $scope.prospect.references.push($scope.temporal_person);

    $scope.temporal_reference.name="";
    $scope.temporal_reference.lastname_materno="";
    $scope.temporal_reference.lastname_paterno="";
    $scope.temporal_reference.mail="";
    $scope.temporal_reference.phone="";
    $scope.temporal_reference.birthday=new Date();
    $scope.newPerson();
    console.log($scope.prospect.references);

  };
  $scope.deleteRef = function(index) {
    $scope.prospect.references.splice(index,1);
  };
  $scope.deleteSon = function(index) {
    $scope.prospect.sons.splice(index,1);
  };
    

  }]);
  