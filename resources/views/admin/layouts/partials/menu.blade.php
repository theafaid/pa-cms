<div class="card">
    <div class="card-header">
        Menu
    </div>
    <div class="card-body">
        <div class="menu-links">
            <a class="btn {{is_active_link() ? 'btn-primary' : 'btn-light' }}"href="{{route('dashboard.index')}}">
                <i class="fa fa-dashboard"></i>
                Dashboard
            </a>
            <a class="btn {{is_active_link('settings') ? 'btn-primary' : 'btn-light' }}" href="{{route('settings.index')}}">
                <i class="fa fa-cog"></i>
                Settings
            </a>
            <a class="btn {{is_active_link('categories') ? 'btn-primary' : 'btn-light' }}" href="{{route('categories.index')}}">
                <i class="fa fa-list"></i>
                Categories
            </a>
            <a class="btn btn-danger" href="{{route('logout')}}">
                <i class="fa fa-power-off"></i>
                Logout
            </a>
        </div>
    </div>
</div>