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
        </div>
    </div>
</div>