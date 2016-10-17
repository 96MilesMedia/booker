@extends('backend.layout.default')
@section('content')
    <div class="page-wrap" id="bookings">
        <div class="section section--right">
            <p><span class="body">New Booking</span>
                <a href="{!! route('newBooking') !!}" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
                    <i class="material-icons">add</i>
                </a>
            </p>
        </div>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Name</th>
                    <th>Size</th>
                    <th class="mdl-data-table__cell--non-numeric">Date</th>
                    <th class="mdl-data-table__cell--non-numeric">Time</th>
                    <th class="mdl-data-table__cell--non-numeric">Email</th>
                    <th class="mdl-data-table__cell--non-numeric">Telephone</th>
                    <th class="mdl-data-table__cell--non-numeric">Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="booking in bookings" v-cloak>
                    <td class="mdl-data-table__cell--non-numeric">{{ booking.name }}</td>
                    <td>{{ booking.size }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ booking.date }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ booking.time }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ booking.email }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ booking.telephone }}</td>
                    <td class="mdl-data-table__cell--non-numeric">
                        <span class="mdl-badge" data-badge="♥" v-if="booking.status == 'Pending'">{{ booking.status }}</span>
                        <span v-if="booking.status != 'Pending'">{{ booking.status }}</span>
                    </td>
                    <td>
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored" v-on:click="viewBooking($event, booking)">
                          <i class="material-icons">settings</i>
                        </button>

                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect margin-left-sm" id="show-dialog" v-on:click="deleteBooking($event, booking)">
                          <i class="material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">

        var viewRoute = "{!! route('viewBooking', ['id' => '']) !!}";
    </script>
@stop