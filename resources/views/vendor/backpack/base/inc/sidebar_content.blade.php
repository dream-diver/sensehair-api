<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>

@if (backpack_user()->can('bookings.index'))
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('booking') }}'><i class='nav-icon la la-bookmark'></i>
        Bookings</a></li>
@endif

@if (backpack_user()->can('bookings.index'))
    <li class='nav-item'><a class='nav-link' href='{{ route('planner') }}'><i class='nav-icon la la-bookmark'></i>
        Planner</a></li>
@endif

@if (backpack_user()->can('services.index'))
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('career-application') }}'><i
        class='nav-icon la la-briefcase'></i> Career applications</a></li>
@endif

@if (backpack_user()->can('services.index'))
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('promocode') }}'><i class='nav-icon la la-ticket-alt'></i>
        Promocodes</a></li>
@endif


@if (backpack_user()->can('services.index'))
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('service') }}'><i class='nav-icon la la-cut'></i>
        Services</a></li>
@endif

{{-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-question'></i> Users</a></li> --}}
@if (backpack_user()->can('users.index'))
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i>
                    <span>Users</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i
                        class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i
                        class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
        </ul>
    </li>
@endif
