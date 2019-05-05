<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-globe"></i>
                <b class="caret hidden-sm hidden-xs"></b>
                <span class="notification hidden-sm hidden-xs"></span>
				<p class="hidden-lg hidden-md">
					5 Notifications
					<b class="caret"></b>
				</p>
            </a>
            <ul class="dropdown-menu">
            <li><a href="#">Notification 1</a></li>
            <li><a href="#">Notification 2</a></li>
            <li><a href="#">Notification 3</a></li>
            <li><a href="#">Notification 4</a></li>
            <li><a href="#">Another notification</a></li>
            </ul>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="#" class="username">
                <i class="fas fa-user-circle fa-fw"></i>&nbsp;&nbsp;{{ Auth::user()->username }}
            </a>
        </li>
        <li>
            <a class="" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        <li class="separator hidden-lg"></li>
    </ul>
</div>
