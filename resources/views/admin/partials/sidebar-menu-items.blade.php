<ul class="main-menu" id="all-menu-items" role="menu">
    <li class="menu-title" role="presentation" data-lang="hr-title-main">Main</li>
    <li class="slide">
        <a href="#!" class="side-menu__item" role="menuitem">
            <span class="side_menu_icon"><i class="ri-home-2-line"></i></span>
            <span class="side-menu__label" data-lang="hr-dashboards">Admin Users</span>
            <i class="ri-arrow-down-s-line side-menu__angle"></i>
        </a>
        <ul class="slide-menu" role="menu">
            <li class="slide">
                <a href="{{ url(env('ADMIN_URL_PREFIX'). '/admin-users') }}" class="side-menu__item" role="menuitem" data-lang="hr-dashboards-ecommerce">Users</a>
            </li>
        </ul>
    </li>
    <li class="slide">
        <a href="#!" class="side-menu__item" role="menuitem">
            <span class="side_menu_icon"><i class="ri-layout-line"></i></span>
            <span class="side-menu__label" data-lang="hr-layout">Applicants</span>
            <i class="ri-arrow-down-s-line side-menu__angle"></i>
        </a>
        <ul class="slide-menu" role="menu">
            <li class="slide">
                <a href="{{ url(env('ADMIN_URL_PREFIX'). '/applicants') }}"  class="side-menu__item" role="menuitem" data-lang="hr-layout-horizontal">Applicants List</a>
            </li>
            <!-- <li class="slide">
                <a href="{{ url(env('ADMIN_URL_PREFIX'). '/upload-result') }}"  class="side-menu__item" role="menuitem" data-lang="hr-layout-horizontal">Upload Results</a>
            </li> -->
        </ul>
    </li>
</ul>
