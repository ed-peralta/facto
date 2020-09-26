<?php
session_start( );
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" ng-app="Facto">
  <head>
    <link rel="icon" href="">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet"; href="css/angular-datatables.css">
    <link rel="stylesheet"; href="css/angular-ui-tree.css">
    <link rel="stylesheet"; href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/angular-material.min.css">
	  <link rel="stylesheet" href="css/fontawesome/css/all.css">
    <?php require_once("../src/js/scripts.php");?>
    <meta charset="utf-8">
    <title>COPO</title>
  </head>
  <body style="background-color:rgb(234, 235, 237);"  ng-controller="myCtrl">
    <div setyle="display: flex;
  flex-flow: column;
  height: 100%;">
    <div class="section-header">
      <div class="filter">
        <?php require_once("../src/navbar/material-navbar-menu.php");?>
        <div class="header">
          <div class="header-title"><strong>{{pageTitle}}</strong></div>
          <div class="header-subtitle"> <strong>{{currentUser.user_name+' '+currentUser.user_lastname}}</strong></div>
        </div>
      </div>
    </div>
    <div style="margin-top:0; width:94%; margin-left:3%;" >
      <div class="principal-container" style="margin-top:0;" >
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li ng-repeat="breadcrumb in breadcrumbs.get() track by breadcrumb.path" class="breadcrumb-item" ng-class="{ active: $last }">
              <a ng-if="!$last" ng-href="#!{{ breadcrumb.path }}" ng-bind="breadcrumb.label" ></a>
              <a ng-if="$last" ng-bind="breadcrumb.label"></a>
            </li>
          </ol>
        </nav>
        <div ng-view class="principal-view"></div>
      </div>
    </div>
    <!-- Footer -->
    <footer class="footer " id="cardContainer">
      <div class="container ">
        <div class="row">
          <div class="col-md-4 ">
            <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Footer Content</h5>
            <p>Here you can use rows and columns here to organize your footer content. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          </div>      <!-- Grid column -->
          <hr class="clearfix w-100 d-md-none">      <!-- Grid column -->
          <div class="col-md-2 mx-auto">        <!-- Links -->
            <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
            <ul class="list-unstyled">
              <li><a href="#!">Link 1</a></li>
              <li><a href="#!">Link 2</a></li>
              <li><a href="#!">Link 3</a></li>
              <li><a href="#!">Link 4</a></li>
            </ul>
          </div>      <!-- Grid column -->
          <hr class="clearfix w-100 d-md-none">      <!-- Grid column -->
          <div class="col-md-2 mx-auto">        <!-- Links -->
            <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
            <ul class="list-unstyled">
              <li><a href="#!">Link 1</a></li>
              <li><a href="#!">Link 2</a></li>
              <li><a href="#!">Link 3</a></li>
              <li><a href="#!">Link 4</a></li>
            </ul>
          </div>      <!-- Grid column -->
          <hr class="clearfix w-100 d-md-none">      <!-- Grid column -->
          <div class="col-md-2 mx-auto">        <!-- Links -->
            <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>
            <ul class="list-unstyled">
              <li><a href="#!">Link 1</a></li>
              <li><a href="#!">Link 2</a></li>
              <li><a href="#!">Link 3</a></li>
              <li><a href="#!">Link 4</a></li>
            </ul>
          </div>      <!-- Grid column -->
        </div>    <!-- Grid row -->
      </div>  <!-- Footer Links -->
      <div class="footer-copyright text-center ">
        <div class="container" style="padding-top:0.5em;">
          © 2018 Copyright:
          <a href=""> Facto</a>
        </div>
      </div>
    </footer>
    </div>
  </body>
</html>
