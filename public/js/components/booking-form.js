/**
 * Component: Booking Form
 *
 * Handles the assigning of data to a booking form.
 *
 * At the moment this is handled by Laravel actually
 * returning the booking data on the controller method
 * being loaded - but may actually change this to load
 * the data on the fly with a seperate API point.
 */
new Vue({
    el: '#bookingForm',
    data: {
        booking: booking.data
    }
})