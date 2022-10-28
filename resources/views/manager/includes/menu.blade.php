<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            
            @foreach (auth()->user()->role->resources as $resource)
                <li class="nav-item">
                    <a class="nav-link @if (request()->is('manager/users*')) active @endif" href="{{ route('users.index') }}">
                        <span data-feather="file"></span>
                        Usuários
                    </a>
                </li>
            @endforeach

            {{-- <li class="nav-item">
                <a class="nav-link @if (request()->is('manager/users*')) active @endif" href="{{route('users.index')}}">
                    <span data-feather="file"></span>
                    Usuários
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link @if (request()->is('manager/roles*')) active @endif" href="{{route('roles.index')}}">
                    <span data-feather="home"></span>
                    Papéis <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (request()->is('manager/resources*')) active @endif" href="{{route('resources.index')}}">
                    <span data-feather="file"></span>
                    Recursos
                </a>
            </li> --}}
        </ul>
    </div>
</nav>
