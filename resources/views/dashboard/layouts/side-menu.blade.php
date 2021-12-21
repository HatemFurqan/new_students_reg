<div class="main-menu menu-fixed menu-light menu-accordion  menu-shadow " data-scroll-to-active="true" >
    <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item">
                <a href="{{ route('dashboard.home') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الرئيسية</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dashboard.favorite-times.index') }}">
                    <i class="ft ft-clock"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الأوقات المفضلة</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.favorite-times.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft ft-clock"></i>
                            عرض جميع الأوقات
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.favorite-times.create') }}">
                    <i class="ft ft-edit"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">اضافة وقت جديد</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.favorite-times.create') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft ft-clock"></i>
                            عرض جميع الأوقات
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('dashboard.coupons.index') }}">
                    <i class="ft ft-percent"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الكوبونات</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.coupons.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft ft-percent"></i>
                            عرض جميع الكوبونات
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.coupons.create') }}">
                    <i class="ft ft-plus-circle"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">اضافة كوبون جديد</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.coupons.create') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft plus-circle"></i>
                            عرض جميع الكوبونات
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

    </div>
</div>
