<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo"></div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
    <!-- Page -->
        <li class="menu-item menu-open">

            <ul class="list-unstyled menu-sub menu-open">
                <?php 
                    foreach (Session::get('menu') as $key => $value):
                ?>
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class=""></i>
                            <div data-i18n="Layouts">{{ $value->nombreModulo }}</div>
                        </a>
                <?php
                        foreach ($value->opciones as $k => $v):
                ?>
                            <li class="list-inline-item">
                                <a href="/{{ $v->vista }}" class="menu-link">
                                    <div data-i18n="Collapsed menu">{{ $v->detalleOpcion }}</div>
                                </a>
                            </li>
                <?php            
                        endforeach;
                    endforeach;
                ?>
                <!-- <li class="list-inline-item">
                    <a href="/registro" class="menu-link">
                        <div data-i18n="Collapsed menu">Registro</div>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="/cotizacion" class="menu-link">
                        <div data-i18n="Collapsed menu">Cotizador</div>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="/clientes" class="menu-link">
                        <div data-i18n="Content navbar">Mis Clientes</div>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="/cotizaciones" class="menu-link">
                        <div data-i18n="Content nav + Sidebar">Mis Cotizaciones</div>
                    </a>
                </li> -->

            </ul>
        </li>
    </ul>
</aside>