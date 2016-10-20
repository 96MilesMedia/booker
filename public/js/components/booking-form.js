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
var bookingForm = new Vue({
    el: '#bookingForm',
    data: booking.data,
    watch: {
        date: function (value) {
            console.log("watching");
            this.getBookings(value);
        }
    },
    methods: {

        reloadDate: function () {
            this.getBookings(this.date);
        },

        getBookings: function (value) {

            var newDate = moment(value, 'DD-MM-YYYY').format('YYYY-MM-DD');

            this.$http.get('/api/booking/' + newDate + '/valid',
            {
                emulateHTTP: true,
                emulateJSON: true
            })
            .then(function (success) {
                var data = success.body.data;

                this.loadTImes(data);
            });
        },

        loadTImes: function (data) {

            // Load the settings from the storage
            var settings = JSON.parse(localStorage.getItem('BOOKING_SETTINGS'));

            // Organise times that have been pre-booked
            var timesBooked = [];
            $.each(data, function (index, value) {

                var rangeFrom = String(value.time);

                // Format date
                var newDate = moment(value.date, 'DD-MM-YYYY').format('YYYY-MM-DD');

                // Calculate the range of the booking e.g 10:30am with a time_allocation of 30 minutes should have 10:30am
                var hour = moment(newDate + 'T' + value.time).add(settings.time_allocation, 'minutes').hour();
                var minutes = moment(newDate + 'T' + value.time).add(settings.time_allocation, 'minutes').minutes();
                var amPm = rangeFrom.slice(5, 7);

                var rangeTo = hour + ':' + minutes + amPm;

                var range = [rangeFrom, rangeTo];

                timesBooked.push(range);

            });

            var timePickerSettings = {
                disableTimeRanges: [
                    ['10:00am', '10:30am']
                ],
                minTime: settings.opening_time,
                maxTime: settings.closing_time,
                step: settings.time_allocation,
                forceRoundTime: true
            };

            $('#time').timepicker(timePickerSettings);

            this.timeActive = true;
        }
    }
});

// Directive binding just seems so overly convuluted
$('#date').change(function() {
    var value = $(this).val();
    bookingForm.$data.date = value;
});

$('#time').change(function() {
    var value = $(this).val();
    bookingForm.$data.time = value;
});