/**
 * Component: Booking Count
 *
 * Vue Component gets the number of pending bookings
 */
new Vue({
    el: '#bookingCount',
    data: {
        bookingCount: 0
    },
    beforeCreate: function () {
        var self = this;
        console.log(12313)
        this.$http.get('/backend/booking/all', [{status: 'pending'}], {method: 'GET', emulateHTTP: true, emulateJSON: true})
            .then(function (success) {
                self.bookingCount = success.body.data.length;
            });
    }
})