<?php
use Helpers\Url;
use Helpers\Hooks;
use Helpers\AdminLTE\AdminLTE;
use Helpers\AdminLTE\Assets;
use Helpers\Session;
?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="/media/profiles/<?=Session::get("avatar");?>" class="user-image" alt="User Image" />
                  <span class="hidden-xs"><?=Session::get("givenname");?> <?=Session::get("surname");?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="/media/profiles/<?=Session::get("avatar");?>" class="img-circle" alt="User Image" />
                    <p>
                       <?=Session::get("givenname");?> <?=Session::get("surname");?> - <?=Session::get("title");?> 
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="/logoff" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>