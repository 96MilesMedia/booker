<!-- Uses a header that scrolls with the text, rather than staying
  locked at the top -->

<header class="mdl-layout__header mdl-layout__header--main mdl-layout__header--scroll">
    <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">Control Panel</span>

        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation">
            <div id="bookingCount">
                <a class="mdl-navigation__link" href="/backend/booking"><span class="mdl-badge" v-bind:data-badge="bookingCount">Bookings</span></a>
            </div>
            <a class="mdl-navigation__link" href="/backend/settings"><i class="fa fa-cogs"></i> Settings</a>
            <div id="auth">
                <a class="mdl-navigation__link cursor" v-on:click="logout($event)"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </nav>
    </div>
</header>
<div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Admin Menu</span>
    <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="/backend/dashboard">Dashboard</a>
        <a class="mdl-navigation__link" href="/backend/booking">Bookings</a>
        <a class="mdl-navigation__link" href="/backend/booking/settings/view">Booking Settings</a>
        <a class="mdl-navigation__link" href="">About Page</a>
        <div id="auth">
            <a class="mdl-navigation__link" v-on:click="logout($event)"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
    </nav>
</div>

<header class="mdl-layout__header mdl-layout__header--sub mdl-layout__header--scroll">
    <div class="mdl-layout__header-row">
        <div class="mdl-grid full-width">
            <div class="mdl-cell--6-col">
                <!-- Title -->
                <span class="mdl-layout-title"><h3 class="primary-title primary-title--white">{!! (isset($page_title) ? $page_title : "") !!}</h3></span>
            </div>
            <div class="mdl-cell--6-col">
                <div class="section section--right padding-top-md" id="goBack">
                    @if (!isset($hide_back) || $hide_back == false)
                    <a v-on:click="goBack($event)" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" id="new-booking">
                        <i class="material-icons">navigate_before</i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
