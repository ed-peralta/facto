
<?php
$username = null;
$password = null;
$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if(!empty($_POST["username"]) && !empty($_POST["password"])) {
    require_once('../dbase/conn.php');
    $username = $_POST["username"];
    $password = $_POST["password"];
    $results=mysqli_query($db,"SELECT user_id,user_name,user_username,user_mail,user_lastname_paterno,user_lastname_materno FROM users WHERE user_username='".$username."' AND user_password='".$password."'");

    $row=mysqli_fetch_array($results);

    if($row) {
      session_start();
      $_SESSION["authenticated"] = true;
      $_SESSION["user"]=$row;
      var_dump($_SESSION);
      header('Location: index.php');
    }
    else {
        header('Location: login.php');
    }
  } else {
      header('Location: login.php');
  }
} else {
session_start();
if(empty($_SESSION["authenticated"]) || $_SESSION["authenticated"] != 'true'){
  

?>
<!DOCTYPE html>
<html lang="en" ng-app="Login" style="height: 100%;">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Facto Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="">
    <link rel="stylesheet" href="css/app.css">
    <?php require_once("../src/js/scripts.php");?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

</head>
<body ng-controller="myCtrl" style="height: 100%;">
<!-- [/page] -->
<div class="container" style="height:100%;">
  <div class="row" style="padding-top:8em;">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="jumbotron">
        <h1 class="display-4">COPO</h1>
        <form class="needs-validation " novalidate id="login" method="post" action="login.php">
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 mb-3">
              <label for="validationCustom01"> {{username}}</label>
              <input type="text" class="form-control" id="validationCustom01" name="username" placeholder="Username" value="" required>
              <div class="valid-feedback">
                  Looks good!
              </div>
            </div>
            <div class="col-md-3  "></div>
          </div>
          <div class="row">
            <div class="col-md-3  "></div>
            <div class="col-md-6 mb-3">
              <input type="password" class="form-control" id="validationCustom02" name="password"  placeholder="password" value="" required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-3  "></div>
          </div>
          <hr class="my-4">
          <div class="col-md-12 text-center">
            <button class="btn btn-primary" type="submit">Entrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

var app = angular.module('Login',[]);
app.controller('myCtrl', function($scope,$http,$window) {
  $scope.username="";
  $scope.password='';
  $scope.login=function() {
   $http.post("login.php", {
                'username':$scope.username,
                'password':$scope.password
            }).then(function(response){
                    console.log("Data Inserted Successfully");
                    //$scope.getUs();
                },function(error){
                    alert("Sorry! Data Couldn't be inserted!");
                    console.error(error);

                });
      //  this.user=response.data.records;

        //this.user=response.data.records;

  };
});
</script>

</html>
<?php }else{
  header('Location: index.php');
} }?>
