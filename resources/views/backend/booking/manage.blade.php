@extends('backend.layout.default')
@section('content')

    {!! Form::open(['method' => 'PUT', 'url' => "/backend/booking/".$booking['data']['uid']]) !!}
    <div class="page-wrap" id="bookingForm">
        <div class="mdl-grid">
            <div class="mdl-cell--9-col">
                @include('backend.booking.booking-form')

                <div class="section section--right">
                    <button type="submit"
                            name="update"
                            value="update"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"
                            v-cloak v-if="booking.status != 'Cancelled'">
                        Update Details
                    </button>
                </div>
            </div>
            <div class="mdl-cell--3-col">
                <div class="section section--padded-sides">
                    <div v-if="booking.status == 'Cancelled'">
                        <p class="body">Booking has either been cancelled or rejected. There are no more actions that can be assigned to this booking now.</p>
                    </div>
                    <div v-cloak v-if="booking.status != 'Cancelled'">
                        <button type="submit"
                                name="confirm-booking"
                                value="confirm"
                                class="mdl-button
                                       mdl-js-button
                                       mdl-button--raised
                                       mdl-button--colored--positive
                                       mdl-js-ripple-effect
                                       margin-bottom-sm
                                       full-width"
                                v-if="booking.status != 'Rejected' && booking.status != 'Confirmed'">
                            <i class="material-icons">assignment_turned_in</i> Confirm Booking
                        </button>

                        <button type="submit"
                                name="reject-booking"
                                value="reject"
                                class="mdl-button
                                       mdl-js-button
                                       mdl-button--raised
                                       mdl-button--colored
                                       mdl-js-ripple-effect
                                       margin-bottom-sm
                                       full-width"
                                 v-if="booking.status != 'Rejected' && booking.status != 'Confirmed'">
                          <i class="material-icons">assignment_late</i> Reject Booking
                        </button>

                        <button type="submit"
                                name="cancel-booking"
                                value="cancel"
                                class="mdl-button
                                      mdl-js-button
                                      mdl-button--raised
                                      mdl-button--accent
                                      mdl-js-ripple-effect
                                      margin-bottom-sm
                                      full-width">
                            <i class="material-icons">highlight_off</i> Cancel Booking
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <script type="text/javascript">
        var booking = {!! json_encode($booking) !!};
    </script>
@stop