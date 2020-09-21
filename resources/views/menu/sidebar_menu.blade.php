@foreach ($adm_menu as $mnu)
    @if (!$mnu['children']->isEMPTY())
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
            <div class="sb-nav-link-icon"><i class="{{ $mnu->icon }}"></i></div>
                {{$mnu->name}}
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>

        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                @foreach ($mnu['children'] as $mnu1)
                    @if (!$mnu1['children']->isEMPTY())
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            <div class="sb-nav-link-icon"><i class="{{ $mnu1->icon }}"></i></div>
                                {{$mnu1->name}}
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                @foreach ($mnu1['children'] as $mnu2)
                                    <a class="nav-link" href="{{ route($mnu2->route) }}">
                                        <div class="sb-nav-link-icon"><i class="{{ $mnu2->icon }}"></i></div>
                                        {{ $mnu2->name }}
                                    </a>
                                @endforeach
                            </nav>
                        </div>
                    @else 
                        <a class="nav-link" href="{{ route($mnu1->route) }}">
                            <div class="sb-nav-link-icon"><i class="{{ $mnu1->icon }}"></i></div>
                            {{ $mnu1->name }}
                        </a>
                    @endif

                @endforeach
            </nav>
        </div>
    @else
        <a class="nav-link" href="{{ route($mnu->route) }}">
            <div class="sb-nav-link-icon"><i class="{{ $mnu->icon }}"></i></div>
            Dashboard
        </a>
    @endif
    
@endforeach