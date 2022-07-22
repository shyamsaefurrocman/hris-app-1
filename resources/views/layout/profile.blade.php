<li class="list-inline-item mb-0 ms-1">
    <div class="dropdown dropdown-primary">
        @if (Auth::user()->foto != null)
            <button type="button" class="btn btn-soft-light dropdown-toggle p-0" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><img src="{{ asset('storage/foto/' . Auth::user()->foto) }}"
                    class="avatar avatar-ex-small rounded" alt=""></button>
        @else
            <button type="button" class="btn btn-soft-light dropdown-toggle p-0" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><img src="{{ asset('storage/foto/user.png') }}"
                    class="avatar avatar-ex-small rounded" alt=""></button>
        @endif
        <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow border-0 mt-3 py-3"
            style="min-width: 200px;">
            @if (Auth::user()->foto != null)
                <a role="button" onclick="handleShowAdmin('{{ $pegawais }}', '{{ Auth::user()->id_user }}')"
                    class="dropdown-item d-flex align-items-center text-dark pb-3">
                    <img src="{{ asset('storage/foto/' . Auth::user()->foto) }}"
                        class="avatar avatar-md-sm rounded-circle border shadow" alt="">
                    <div class="flex-1 ms-2">
                        <span class="d-block">{{ Auth::user()->nama }}</span>
                        <small class="text-muted">{{ Auth::user()->role }}</small>
                    </div>
                </a>
            @else
                <a role="button" onclick="handleShowAdmin('{{ $pegawais }}', '{{ Auth::user()->id_user }}')"
                    class="dropdown-item d-flex align-items-center text-dark pb-3">
                    <img src="{{ asset('storage/foto/user.png') }}"
                        class="avatar avatar-md-sm rounded-circle border shadow" alt="">
                    <div class="flex-1 ms-2">
                        <span class="d-block">{{ Auth::user()->nama }}</span>
                        <small class="text-muted">{{ Auth::user()->role }}</small>
                    </div>
                </a>
            @endif
            <div class="dropdown-divider border-top"></div>
            <a class="dropdown-item text-dark" href="{{ route('logout') }}"><span class="mb-0 d-inline-block me-1"><i
                        class="ti ti-logout"></i></span>
                Logout</a>
        </div>
    </div>
</li>
