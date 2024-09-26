<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed {{ request()->routeIs('hero-sections.index', 'our-principles.index', 'company-stats.index') ? '' : 'collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Landing Page</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse {{ request()->routeIs('hero-sections.index', 'our-principles.index', 'company-stats.index') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('hero-sections.index') }}" class="{{ request()->routeIs('hero-sections.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Hero Section</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('our-principles.index') }}" class="{{ request()->routeIs('our-principles.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Our Principle</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('company-stats.index') }}" class="{{ request()->routeIs('company-stats.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Company Stats</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('our-teams.index') ? 'active' : '' }}" href="{{ route('our-teams.index') }}">
                <i class="bi bi-grid"></i>
                <span>Our Team</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('our-products.index') ? 'active' : '' }}" href="{{ route('our-products.index') }}">
                <i class="bi bi-grid"></i>
                <span>Our Product</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('company-about.index') ? 'active' : '' }}" href="{{ route('company-about.index') }}">
                <i class="bi bi-grid"></i>
                <span>About</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed {{ request()->routeIs('our-client.index', 'our-testimoni.index') ? '' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Stories</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse {{ request()->routeIs('our-client.index', 'our-testimoni.index') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('our-client.index') }}" class="{{ request()->routeIs('our-client.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Our Client</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('our-testimoni.index') }}" class="{{ request()->routeIs('our-testimoni.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Testimonials</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Stories Nav -->

    </ul>

</aside><!-- End Sidebar -->
