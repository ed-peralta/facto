<md-sidenav class="md-sidenav-left" md-component-id="closeEventsDisabled"
            md-whiteframe="4" md-disable-close-events >

  <md-toolbar class="md-theme-indigo">
    <h1 class="md-toolbar-tools">Menu</h1>
  </md-toolbar>

  <md-content layout-margin>
    <md-list flex>
        <md-list-item class="md-3-line" ng-repeat="mvc in mod" ng-click="setModule(mvc); toggleSidenav()" href="#!{{mvc.mvc_view}}">
          <i class="fas {{mvc.mvc_icon}}"></i> {{mvc.mvc_name}}
        </md-list-item>
        <md-divider ></md-divider>
        <md-list-item class="md-3-line md-long-text" ng-repeat="menuelment in dropD" >
          <md-menu>
            <md-button aria-label="Open menu with custom trigger"  ng-click="$mdMenu.open()">
              <i class="fas {{menuelment.mvc_icon}}"></i>  {{menuelment.mvc_name}}
            </md-button>
            <md-menu-content width="4" ng-mouseleave="$mdMenu.close()">
              <md-menu-item ng-repeat="options in menuelment.children" ng-click="setModule(options); toggleSidenav()" >
                <md-button href="#!{{options.mvc_view}}">
                  <i class="fas {{options.mvc_icon}}"></i> {{options.mvc_name}}
                </md-button>
              </md-menu-item>
            </md-menu-content>
          </md-menu>
        </md-list-item>
      </md-list>

    <md-button ng-click="toggleSidenav()" class="md-accent">
      Close this Sidenav
    </md-button>
  </md-content>

</md-sidenav>
<md-button class="md-fab md-raised md-primary" aria-label="Eat cake" ng-click="toggleSidenav()"
style="position: fixed;
  top: 0;">
  <md-icon ><i class="fas fa-bars"></i></md-icon>
</md-button>
