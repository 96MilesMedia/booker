@extends('backend.layout.default')
@section('content')
    <div class="page-wrap">
        <div class="mdl-grid">


                <div class="mdl-cell mdl-cell--4-col mdl-cell--middle">
                    <!-- <div class="card-wrap"> -->
                        <div class="info-card-wide mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">Today's Bookings</h2>
                            </div>
                            <div class="mdl-card__supporting-text">
                                View and Manage the bookings scheduled for today's event.
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <a href="/backend/booking/date?date={!! date('Y-m-d') !!}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                    View Bookings
                                </a>
                            </div>
                            <!-- <div class="mdl-card__menu">
                                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                                    <i class="material-icons">share</i>
                                </button>
                            </div> -->
                        </div>
                    <!-- </div> -->
                </div>

                <div class="mdl-cell mdl-cell--4-col mdl-cell--middle">
                    <!-- <div class="card-wrap"> -->
                        <div class="info-card-wide info-card-wide--pending mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">Pending Bookings</h2>
                            </div>
                            <div class="mdl-card__supporting-text">
                                Confirm or Manage recent bookings by customers that require action.
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <a href="/backend/booking" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                    View Pending Bookings
                                </a>
                            </div>
                            <!-- <div class="mdl-card__menu">
                                <span class="mdl-badge" data-badge="4"></span>
                            </div> -->
                        </div>
                    <!-- </div> -->
                </div>

                <div class="mdl-cell mdl-cell--4-col mdl-cell--middle">
                    <!-- <div class="card-wrap"> -->
                        <div class="info-card-wide info-card-wide--new mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">New Booking</h2>
                            </div>
                            <div class="mdl-card__supporting-text">
                                Create a new booking manually for a customer...
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <a href="/backend/booking/new" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                    Create Booking
                                </a>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>

        </div>
    </div>
@stop