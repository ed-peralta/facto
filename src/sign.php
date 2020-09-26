
<?php
$username = null;
$password = null;
$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(!empty($_POST["username"]) && !empty($_POST["password"])) {
    require_once('../dbase/conn.php');
    $username = $_POST["username"];
    $password = $_POST["password"];
    $results=mysqli_query($db,"SELECT * FROM users WHERE user_username='".$username."' AND user_password='".$password."'");
    if($results) {
        session_start();
        $_SESSION["authenticated"] = 'true';
        var_dump($results);
        //header('Location: index.php');
    }
    else {
        header('Location: login.php');
    }

  } else {
      header('Location: login.php');
  }
} else {
?>
<!DOCTYPE html>
<html lang="en" ng-app="Login">
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
<body ng-controller="myCtrl">
<!-- [/page] -->
<div class="container">
  <div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8">
      <div class="jumbotron">
          <h1 class="display-4">Hello, world!</h1>
          <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
          <form class="needs-validation" novalidate id="login" method="post">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">First name {{username}}</label>
      <input type="text" class="form-control" id="validationCustom01" ng-model="username" placeholder="First name" value="{{username}}" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Last name</label>
      <input type="text" class="form-control" id="validationCustom02" ng-model="password"  placeholder="Last name" value="{{password}}" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustomUsername">Username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">@</span>
        </div>
        <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback">
          Please choose a username.
        </div>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">City</label>
      <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">State</label>
      <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom05">Zip</label>
      <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <button class="btn btn-primary" type="submit" ng-click="login()">Submit form</button>
  <input type="submit" value="Login">
</form>

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
          <hr class="my-4">
          <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
          <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
      </div>
    </div>

  </div>

</div>
</body>
</html>
<?php } ?>
