<!-- Uses a header that scrolls with the text, rather than staying
  locked at the top -->

<header class="mdl-layout__header mdl-layout__header--main mdl-layout__header--scroll">
    <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">Control Panel</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation" id="bookingCount">
            <a class="mdl-navigation__link" href="/backend/booking"><span class="mdl-badge" v-bind:data-badge="bookingCount">Bookings</span></a>
            <a class="mdl-navigation__link" href=""><i class="fa fa-cogs"></i> Settings</a>
            <a class="mdl-navigation__link" href=""><i class="fa fa-sign-out"></i> Logout</a>
        </nav>
    </div>
</header>
<div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Admin Menu</span>
    <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="/backend/booking">Bookings</a>
        <a class="mdl-navigation__link" href="/backend/booking/settings/view">Booking Settings</a>
        <a class="mdl-navigation__link" href="">About Page</a>
        <a class="mdl-navigation__link" href=""><i class="fa fa-sign-out"></i> Logout</a>

    </nav>
</div>

<header class="mdl-layout__header mdl-layout__header--sub mdl-layout__header--scroll">
    <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title"><h3 class="primary-title">{!! (isset($page_title) ? $page_title : "") !!}</h3></span>
    </div>
</header>
