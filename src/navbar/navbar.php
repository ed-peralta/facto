<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent" >
    <ul class="navbar-nav mr-auto">
      <li class="nav-item " ng-repeat="mvc in mod" ng-click="setModule(mvc)">
        <a class="nav-link" href="#!{{mvc.mvc_view}}"><i class="fas {{mvc.mvc_icon}}"></i> {{mvc.mvc_name}} <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown" ng-repeat="menuelment in dropD" >
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas {{menuelment.mvc_icon}}"></i>  {{menuelment.mvc_name}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
          <a class="dropdown-item" href="#!{{options.mvc_view}}" ng-repeat="options in menuelment.children" ng-click="setModule(options)"><i class="fas {{options.mvc_icon}}"></i> {{options.mvc_name}}</a>

          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>-->
        </div>
      </li>

      <!--
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    </form>
    <form action="logout.php" method="post" class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-secondary   my-2 my-sm-0" type="submit" data-toggle="tooltip" data-placement="top" title="Salir"><i class="fas fa-sign-out-alt"></i></button>
    </form>
  </div>
</nav>
