app.controller('createProject',function($scope,$http,$routeParams){
  $scope.treeOptions = {
    accept: function(sourceNodeScope, destNodesScope, destIndex) {
      return true;
    },
  };
  $scope.drag=false;
  $scope.editAcept = 0;
  $scope.children=[{
    name:"Ejemplo",
    type:"PCB",
    posfix:10100
  }];
  $scope.sprt=[{
    name:"parte_ejemplo",
    type:"PRT",
    posfix:101
  }];
  $scope.project={
    name:"",
    type:"",
    prefix:"",
    posfix:10000,
    version:"",
    assambly:"",
    description:"",
    icd:{
      name:"",
      assambly:10001,
      files:[],
      enabled:true
    },
    chdn:[],
    sprt:[],
    cprt:[],
    depth:0,
    release:false,
    dateCreated:"",
    dateVerified:"",
    dateAuthorized:"",
    designer:"",
    verifier:"",
    authorizer:"",
    review:"-",
    notes:"",
    price:0,
		disabled:0,
    files:[]
  };
  $scope.rootDepth= function(obj,depth){
    //var d=0;
    //var dpref=0;

    if (obj.chdn.length>0) {
      depth=depth+1;
      if($scope.project.depth<depth){
        $scope.project.depth=depth;
      }
      obj.chdn.forEach(function(el){

          $scope.rootDepth(el,depth);
      });
    }


  };
  //$scope.ID = $routeParams.ID;
  //$scope.start=0;
  $scope.addCh= function (arr,type) {
    var name = prompt("Please enter your name", "XDW1");
      if (name == null || name == "") {
          txt = "User cancelled the prompt.";
      } else {
        switch (type) {
          case "PRT":
            arr.push({
              name:name,
              type:type,
              prefix:"",
              posfix:0,
              assambly:"",
              description:"",
              release:false,
              dateCreated:"",
              dateVerified:"",
              partida:0,
              quantity:0,
              coin:"",
              manufacturer:"",
              manufacturer_number:"",
              provider:"",
              provider_number:"",
              review:"-",
              notes:"",
              price:0,
              files:[],
							disabled:0,
              borrado:false

            });
            break;
          case "PCB":
              arr.push({
                name:name,
                type:type,
                prefix:"",
                posfix:0,
                assambly:"",
                description:"",
                chdn:[],
                sprt:[{
                  name:name,
                  type:"PCB",
                  prefix:"",
                  posfix:0,
                  assambly:"",
                  description:"",
                  release:false,
                  dateCreated:"",
                  dateVerified:"",
                  partida:0,
                  quantity:0,
                  coin:"",
                  manufacturer:"",
                  manufacturer_number:"",
                  provider:"",
                  provider_number:"",
                  review:"-",
                  notes:"",
                  price:0,
                  files:[],
									disabled:0,
                  borrado:false

                }],
                cprt:[],
                depth:0,
                release:false,
                dateCreated:"",
                dateVerified:"",
                dateAuthorized:"",
                designer:"",
                verifier:"",
                authorizer:"",
                review:"-",
                notes:"",
                price:0,
                files:[],
								disabled:0,
                borrado:false
              });
            break;

          default:
            arr.push({
              name:name,
              type:type,
              prefix:"",
              posfix:0,
              assambly:"",
              description:"",
              chdn:[],
              sprt:[],
              cprt:[],
              depth:0,
              release:false,
              dateCreated:"",
              dateVerified:"",
              dateAuthorized:"",
              designer:"",
              verifier:"",
              authorizer:"",
              review:"-",
              notes:"",
              price:0,
              files:[],
							disabled:0,
              borrado:false
            });
            break;

        }
        $scope.updtProj();

      }

  };
  $scope.updtProj=function() {
    $scope.project.depth=0;
    $scope.rootDepth($scope.project,0);
    console.log($scope.project.depth);
    $scope.project.posfix=Math.pow(100,$scope.project.depth+1)*$scope.project.version;
    var j=2;
    //$scope.project.icd.name=$scope.project.name;
    $scope.project.icd.assambly=$scope.project.posfix+1;
    $scope.project.sprt.forEach(function(el) {
      el.posfix=$scope.project.posfix+j;
      j++;
    });
    $scope.updatePosfix($scope.project.chdn,0,$scope.project.posfix);
    $scope.children=$scope.project.chdn;
    $scope.sprt=$scope.project.sprt;
  };
  $scope.rmNode=function(node){
    if (confirm("¿Seguro de eliminar?")) {
      if (confirm("¿Seguro? ¿Seguro?")) {
        $scope.deleteNode(node,$scope.project.chdn);
        $scope.updtProj();
      }

    }

  };
  $scope.deleteNode=function(node,arr) {
    var temp=arr.findIndex(x => x.$$hashKey == node.$$hashKey);
    if (temp>=0) {
      arr.splice(temp, 1);
    }else {
      arr.forEach(function (el) {
        $scope.deleteNode(node,el.chdn);
      });
    }
  }
  $scope.updatePosfix=function(chdn,depth,posfix) {

    depth=depth+1;
    var j=1;

    chdn.forEach(function(el){
      el.posfix=0;
      el.posfix=parseInt(posfix)+(Math.pow(100,$scope.project.depth-depth+1)*j);
      if (el.sprt.length>0) {
        var i=1;
        el.sprt.forEach(function(elem) {
          elem.posfix=el.posfix+i;
          i++;
        });
      }
      console.log("formula"+el.posfix);
      $scope.updatePosfix(el.chdn,depth,el.posfix);
      j++;
    });

  };
  $scope.insert=function(){
    $scope.project.chdn=$scope.children;
  //  console.log($scope.project.lastname);
    //console.log(JSON.stringify($scope.project));
    $http.post("../api/project_crud.php", {
      'activity':'insert',
      'project_name':$scope.project.name,
      'project_json':JSON.stringify($scope.project)
    }).then(function(response){
      console.log(response);
      console.log("Data Inserted Successfully");
      //alert('proyecto insertado');
      window.history.back();
    },function(error){
      alert("Sorry! Data Couldn't be inserted!");
      console.error(error);
    });
  };


});
