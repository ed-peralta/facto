<md-menu  md-position-mode="cascade">
  <md-button class="md-fab md-raised md-primary" aria-label="Eat cake" ng-click="$mdMenu.open($event)"
  style="position: fixed;
    top: 0;">
    <i class="fas fa-bars" style="font-size:1.7em; padding-top:16px;"></i>
  </md-button>
  <md-menu-content width="5">
    <md-menu-item ng-repeat="mvc in mod" >
      <md-button href="#!{{mvc.mvc_view}}" ng-click="setModule(mvc)"> <span md-menu-align-target><i class="fas {{mvc.mvc_icon}}"></i> </span> {{mvc.mvc_name}}</md-button>
    </md-menu-item>
    <md-menu-item ng-repeat="menuelment in dropD">
      <md-menu class="nested-menu" md-position-mode="cascade">
          <md-button aria-label="Open demo menu" ng-click="$mdMenu.open($event)">
            <i class="fas {{menuelment.mvc_icon}}"></i>  {{menuelment.mvc_name}}
          </md-button>
          <md-menu-content width="4">
            <md-menu-item ng-repeat="options in menuelment.children">
              <md-button ng-click="setModule(options)" href="#!{{options.mvc_view}}"> <span md-menu-align-target><i class="fas {{options.mvc_icon}}"></i></span>  {{options.mvc_name}} </md-button>
            </md-menu-item>
          </md-menu-content>
        </md-menu>
    </md-menu-item>
    <md-menu-item >
      <form action="logout.php" method="post" class="form-inline ">
        <md-button type="submit"> <span md-menu-align-target><i class="fas fa-sign-out-alt"></i> </span> Cerrar sesion</md-button>
      </form>
    </md-menu-item>
            <button class="btn btn-outline-danger dropdown-item"  ></button>
  </md-menu-content>
</md-menu>
<!--

<md-menu-item ng-repeat="mvc in mod" >
  <md-button href="#!{{mvc.mvc_view}}" ng-click="setModule(mvc)"> <span md-menu-align-target><i class="fas {{mvc.mvc_icon}}"></i> </span> {{mvc.mvc_name}}</md-button>
</md-menu-item>
<md-menu-item ng-repeat="menuelment in dropD">
  <md-menu class="nested-menu">
    <md-button ng-click="ctrl.onClick(org.department)"><span md-menu-align-target><i class="fas {{menuelment.mvc_icon}}"></i></span> {{menuelment.mvc_name}}</md-button>
    <md-menu-content width="3">
      <md-menu-item ng-repeat="options in menuelment.children">

              <md-button ng-click="ctrl.onClick(person.name)"><span md-menu-align-target>Option</span>  {{options.mvc_name}} </md-button>

      </md-menu-item>
    </md-menu-content>
  </md-menu>
</md-menu-item>


-->
