<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="rounded-circle header-profile-user" src="{{ asset('dashboard/images/users/default-admin-avatar.ico') }}"
            alt="Header Avatar">
        <span class="d-none d-xl-inline-block ms-1">{{ Auth::user() ? Auth::user()->name : "Geust" }}</span>
        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <!-- item-->
        <a class="dropdown-item" href="#">
            <i class="bx bx-user font-size-16 align-middle me-1"></i>
            {{ __('dashboard.profile') }}
        </a>
        {{-- <a class="dropdown-item" href="#">
            <i class="bx bx-wallet font-size-16 align-middle me-1"></i>
            {{ __('dashboard.myWallet') }}
        </a> --}}
        <a class="dropdown-item d-block" href="#">
            {{-- <span class="badge bg-success float-end">11</span> --}}
            <i class="bx bx-wrench font-size-16 align-middle me-1"></i>
            {{ __('dashboard.settings') }}
        </a>
        {{-- <a class="dropdown-item" href="#">
            <i class="bx bx-lock-open font-size-16 align-middle me-1"></i>
            Lock screen
        </a> --}}
        <div class="dropdown-divider"></div>
        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
            {{ __('dashboard.logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>