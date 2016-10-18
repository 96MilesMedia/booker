/**
 * Component: Booking Count
 *
 * Vue Component gets the number of pending bookings
 */
new Vue({
    el: '#bookingSettings',
    data: {
        settings: {}
    },
    beforeCreate: function () {
        var self = this;

        this.$http.get('/backend/booking/settings',
            {
                emulateHTTP: true,
                emulateJSON: true
            })
            .then(function (success) {
                self.settings = success.body.data;
            });
    }
})