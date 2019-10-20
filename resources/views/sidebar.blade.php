<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            @auth

            <li class="nav-item">
                <a class="nav-link" href="main.html">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                    <span class="badge badge-info">NEW</span>
                </a>
            </li>
            <li class="nav-title">Theme</li>
            <li class="nav-item">
                <a class="nav-link" href="colors.html">
                    <i class="nav-icon icon-drop"></i> Colors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="typography.html">
                    <i class="nav-icon icon-pencil"></i> Typography</a>
            </li>

            @if (auth()->user()->role === 1)

            <li class="nav-title">Administration</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-puzzle"></i> Base</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="base/breadcrumb.html">
                            <i class="nav-icon icon-puzzle"></i> Breadcrumb</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/cards.html">
                            <i class="nav-icon icon-puzzle"></i> Cards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/carousel.html">
                            <i class="nav-icon icon-puzzle"></i> Carousel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/collapse.html">
                            <i class="nav-icon icon-puzzle"></i> Collapse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/jumbotron.html">
                            <i class="nav-icon icon-puzzle"></i> Jumbotron</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/list-group.html">
                            <i class="nav-icon icon-puzzle"></i> List group</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/navs.html">
                            <i class="nav-icon icon-puzzle"></i> Navs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/pagination.html">
                            <i class="nav-icon icon-puzzle"></i> Pagination</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/popovers.html">
                            <i class="nav-icon icon-puzzle"></i> Popovers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/progress.html">
                            <i class="nav-icon icon-puzzle"></i> Progress</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/scrollspy.html">
                            <i class="nav-icon icon-puzzle"></i> Scrollspy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/switches.html">
                            <i class="nav-icon icon-puzzle"></i> Switches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/tabs.html">
                            <i class="nav-icon icon-puzzle"></i> Tabs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="base/tooltips.html">
                            <i class="nav-icon icon-puzzle"></i> Tooltips</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('programs.index') }}">
                    <i class="nav-icon icon-pie-chart"></i> Programs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="google-maps.html">
                    <i class="nav-icon icon-map"></i> Google Maps
                    <span class="badge badge-danger">PRO</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="widgets.html">
                    <i class="nav-icon icon-calculator"></i> Widgets
                    <span class="badge badge-info">NEW</span>
                </a>
            </li>
            @endif
            <li class="nav-divider"></li>
            @endauth
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>