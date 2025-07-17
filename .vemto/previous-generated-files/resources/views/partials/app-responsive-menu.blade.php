@can('view-any', App\Models\User::class)
<x-responsive-nav-link
    href="{{ route('dashboard.users.index') }}"
    :active="request()->routeIs('dashboard.users.index')"
>
    {{ __('navigation.users') }}
</x-responsive-nav-link>
@endcan @can('view-any', App\Models\Status::class)
<x-responsive-nav-link
    href="{{ route('dashboard.statuses.index') }}"
    :active="request()->routeIs('dashboard.statuses.index')"
>
    {{ __('navigation.statuses') }}
</x-responsive-nav-link>
@endcan @can('view-any', App\Models\Vehicle::class)
<x-responsive-nav-link
    href="{{ route('dashboard.vehicles.index') }}"
    :active="request()->routeIs('dashboard.vehicles.index')"
>
    {{ __('navigation.vehicles') }}
</x-responsive-nav-link>
@endcan @can('view-any', App\Models\Service::class)
<x-responsive-nav-link
    href="{{ route('dashboard.services.index') }}"
    :active="request()->routeIs('dashboard.services.index')"
>
    {{ __('navigation.services') }}
</x-responsive-nav-link>
@endcan @can('view-any', App\Models\Bill::class)
<x-responsive-nav-link
    href="{{ route('dashboard.bills.index') }}"
    :active="request()->routeIs('dashboard.bills.index')"
>
    {{ __('navigation.bills') }}
</x-responsive-nav-link>
@endcan
