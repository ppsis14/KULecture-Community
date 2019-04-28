<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
    <li>
        <a href="#" class="username">
            <p><i class="fas fa-user-circle fa-fw"></i>&nbsp;&nbsp;{{ Auth::user()->name }}</p>
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
