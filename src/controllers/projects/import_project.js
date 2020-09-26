app.controller('importProject',function($scope,$http,DTOptionsBuilder,$mdDialog,$routeParams,$window){
  $scope.treeOptions = {
    accept: function(sourceNodeScope, destNodesScope, destIndex) {
      return true;
    },
  };
  //$scope.isOpen=false;
  $scope.topDirections = ['left', 'up'];
      $scope.bottomDirections = ['down', 'right'];

      $scope.isOpen = false;

      $scope.availableModes = ['md-fling', 'md-scale'];
      $scope.selectedMode = 'md-fling';

      $scope.availableDirections = ['up', 'down', 'left', 'right'];
      $scope.selectedDirection = 'up';
console.log($scope.isOpen);




  $scope.projId = $routeParams.proj;
	$scope.projclone;
	$scope.option=undefined;
  $scope.project;
  //$scope.version="";
  $scope.drag=false;
  //  $scope.project=$scope.proj.tree_json;
  //console.log($scope.projId);
  var span = $('#confirmButton'),
      win = $(window),
      div = $('#cardContainer');
      divHeight = div.height();

  //$(document).scroll(compute).scroll();
  //$(window).resize(compute).resize();

  function compute() {
    console.log(span.outerHeight());

  var spanHeight = span.outerHeight(),
      spanOffset = span.offset().top,
      divOffset = div.offset().top;
      console.log(spanOffset+"--"+divOffset);

  if (spanOffset<=divOffset) {
    console.log('bottom');
    //span.css('position','absolute');
    span.addClass('bottom');
  }else {
    console.log('no hay');
    span.removeClass('bottom');

    ///span.css('position','fixed');

  }
  console.log('spanOffset='+spanOffset, 'windowScroll='+(divOffset-divHeight));
}
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
};
$scope.rmNode=function(node){
  if (confirm("¿Seguro de eliminar?")) {

      $scope.deleteNode(node,$scope.project.chdn);
      $scope.updtProj();


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
$scope.update=function(){
//  $scope.project.chdn=$scope.children;
//  console.log($scope.project.lastname);
  console.log(JSON.stringify($scope.project));
  $http.post("../api/project_crud.php", {
    'activity':'update',
    'tree_id':$scope.projId,
    'project_name':$scope.project.name,
    'project_json':JSON.stringify($scope.project)
  }).then(function(response){
    console.log(response);
    console.log("Data Inserted Successfully");
    if (!confirm("Proyecto actualizado.\n ¿Continuar editando?.")) {
      window.history.back();
    }


  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};
$scope.printDocumentation=function () {
  console.log("Documentacion");
  $window.open('http://munin.drakkar.mx/api/project_print.php?tree_id='+$scope.projId, '_blank');

  /*
  $http.post("../api/project_print.php", {
    'tree_id':$scope.projId
  }).then(function(response){
    console.log(response);
    console.log("Data Inserted Successfully");
    if (!confirm("Proyecto actualizado.\n ¿Continuar editando?.")) {
      //window.history.back();
    }
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
  */
};
$scope.getProject=function(projId){
  $http.post("../api/project_crud.php", {
    'activity':'get_project',
    'tree_id':projId
  }).then(function(response){
    var temp;
    //console.log(response);
    temp=response.data.records;
    //console.log(temp[0].tree_name);
    $scope.project=JSON.parse(temp[0].tree_json);
    //console.log($scope.project);
    //console.log(temp.tree_json);
    //console.log("Data Inserted Successfully");
  //  $scope.getProjects();
  },function(error){
    alert("Sorry! Data Couldn't be inserted!");
    console.error(error);
  });
};
$scope.rootDepth= function(obj,depth){
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
$scope.getProjects=function(){
  $http.get("../api/project_crud.php").then(function (response) {
    $scope.projects = response.data.records;
  });
};
$scope.getSelectedText= function () {
	if ($scope.option!=undefined) {
		var res=$scope.projects.find(p=>p.tree_id==$scope.option);
		$scope.projclone=JSON.parse(res.tree_json);
		return res.tree_name;
	}else {
		return "seleccionar proyecto fuente";
	}

};
$scope.getProjects();
$scope.getProject($scope.projId);

});
