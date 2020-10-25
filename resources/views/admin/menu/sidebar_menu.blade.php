@php 
$role_id = Session::get('role_id');
@endphp
@foreach ($adm_menu as $mnu)
    @if (!$mnu['children']->isEMPTY())
    @if(roletype1($mnu->menu_id, $role_id))
        <a class="nav-link {{ Request::is('Admin/'.$mnu->route.'/*') ? 'active' : 'collapsed'}}" href="#" data-toggle="collapse" data-target="#collapse{{$mnu->name}}" aria-expanded="false" aria-controls="collapse{{$mnu->name}}">
            <div class="sb-nav-link-icon"><i class="{{ $mnu->icon }}"></i></div>
                {{$mnu->name}}
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>

        <div class="collapse {{ Request::is('Admin/'.$mnu->route.'/*') ? 'show' : null }}" id="collapse{{$mnu->name}}" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordion{{$mnu->name}}">

                @foreach ($mnu['children'] as $mnu1)
                    @if (!$mnu1['children']->isEMPTY())
                    @if(roletype1($mnu1->menu_id, $role_id))
                        <a class="nav-link {{ Request::is('Admin/'.$mnu->route.'/'.$mnu1->route.'/*') ? 'active' : 'collapsed'}}" href="#" data-toggle="collapse" data-target="#pagesCollapse{{$mnu1->name}}" aria-expanded="false" aria-controls="pagesCollapse{{$mnu1->name}}">
                            <div class="sb-nav-link-icon"><i class="{{ $mnu1->icon }}"></i></div>
                                {{$mnu1->name}}
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ Request::is('Admin/'.$mnu->route.'/'.$mnu1->route.'/*') ? 'show' : null }}" id="pagesCollapse{{$mnu1->name}}" aria-labelledby="headingOne" data-parent="#sidenavAccordion{{$mnu->name}}">
                            <nav class="sb-sidenav-menu-nested nav">
                                @foreach ($mnu1['children'] as $mnu2)
                                @if(roletype1($mnu2->menu_id, $role_id))
                                    <a class="nav-link" href="{{ route($mnu2->route) }}">
                                        <div class="sb-nav-link-icon"><i class="{{ $mnu2->icon }}"></i></div>
                                        {{ $mnu2->name }}
                                    </a>
                                    @endif
                                @endforeach
                            </nav>
                        </div>
                    @endif
                    @else 
                    @if(roletype1($mnu1->menu_id, $role_id))
                        <a class="nav-link {{ Request::is('Admin/'.$mnu->route.'/'.$mnu1->route) ? 'active' : null }}" href="{{ route($mnu1->route) }}">
                            <div class="sb-nav-link-icon"><i class="{{ $mnu1->icon }}"></i></div>
                            {{ $mnu1->name }}
                        </a>
                    @endif
                    @endif

                @endforeach
            </nav>
        </div>
    @endif
    @else
    @if(roletype1($mnu->menu_id, $role_id))
        <a class="nav-link" href="{{ route($mnu->route) }}">
            <div class="sb-nav-link-icon"><i class="{{ $mnu->icon }}"></i></div>
            {{ $mnu->name}}
        </a>
    @endif
    @endif
    
@endforeach