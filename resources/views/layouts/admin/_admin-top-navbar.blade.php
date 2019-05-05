
    <div class="collapse navbar-collapse">
        <!-- <ul class="nav navbar-nav navbar-left">
            <li>
               <a href="">
                    <i class="fa fa-search"></i>
                    <p class="hidden-lg hidden-md">Search</p>
                </a>
            </li>
        </ul> -->

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <p>
                            {{Auth::user()->name}}
                            <b class="caret"></b>
                        </p>

                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <p>Log out</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            <li class="separator hidden-lg"></li>
        </ul>
    </div>
