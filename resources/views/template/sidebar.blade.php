<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="row">
        <div class="col-12 text-center">
            <img class="logo-sidebar" src="../../assets/img/veris/icono-ism-bn.svg">
        </div>
    </div>
    <!-- <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img class="logo-sidebar" src="../../assets/img/veris/isotipo.svg">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Veris</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div> -->

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach (Session::get('menu') as $value)
        <li class="menu-item @if($loop->first) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <!-- <i class="menu-icon tf-icons ti square-dot"></i> -->
                <i class="me-2 fa-solid fa-circle-notch"></i>
                <div data-i18n="{{ $value->nombreModulo }}">{{ $value->nombreModulo }}</div>
                <!-- <div class="badge bg-label-primary rounded-pill ms-auto">3</div> -->
            </a>
            @foreach ($value->opciones as $v)
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/{{ $value->vista }}/{{ $v->vista }}" class="menu-link">
                        <div data-i18n="{{ $v->detalleOpcion }}">{{ $v->detalleOpcion }}</div>
                    </a>
                </li>
            </ul>
            @endforeach
        </li>
        @endforeach
    </ul>
</aside>