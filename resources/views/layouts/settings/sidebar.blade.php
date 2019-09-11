<div class="col-md-3">

    <div class="card">
        <div class="settings-menu">
            <div class="card-header">Settings </div>
            <ul class="list-group">
                <a 
                    href="{{ route('settings') }}"
                    class="{{ request()->path() === 'settings' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action' }}">
                    General Settings
                </a>
                {{-- <a 
                    href="{{ route('settings.processing-centres') }}"
                    class="{{ request()->path() === 'settings/processing-centres' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action' }}">
                    Processing Centres
                </a> --}}
                <a 
                    href="{{ route('settings.employees') }}"
                    class="{{ request()->path() === 'settings/employees' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action' }}">
                    Employees
                </a>
                <a 
                    href="{{ route('settings.customers') }}"
                    class="{{ request()->path() === 'settings/customers' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action' }}">
                    Customers
                </a>
                <a 
                    href="{{ route('settings.wastes') }}"
                    class="{{ request()->path() === 'settings/wastes' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action' }}">
                    Waste Items
                </a>
                <a 
                    href="{{ route('settings.areas') }}"
                    class="{{ request()->path() === 'settings/areas' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action' }}">
                    Areas
                </a>
                <a 
                    href="{{ route('settings.pricelists') }}"
                    class="{{ request()->path() === 'settings/pricelists' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action' }}">
                    Pricelists
                </a>
                <a 
                    href="{{ route('settings.vehicles') }}"
                    class="{{ request()->path() === 'settings/vehicles' ? 'list-group-item list-group-item-action active' : 'list-group-item list-group-item-action' }}">
                    Vehicles
                </a>
            </ul>
        </div>
    </div>
</div>