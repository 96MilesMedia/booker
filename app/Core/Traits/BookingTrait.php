<?php

namespace App\Core\Traits;
use App\Models\Booking;

trait BookingTrait {

    public function updateBooking($id)
    {
        $request = $this->request->all();

        $booking = Booking::where('uid', $id)->first();

        foreach ($request as $key => $value) {
            $booking->{$key} = $value;
        }

        // Backend picking up manual submits for the time being
        if (isset($request['confirm-booking'])) {
            $booking->status = self::STATUS_CONFIRMED;
        }

        if (isset($request['cancel-booking'])) {
            $booking->status = self::STATUS_CANCELLED;
        }

        if (isset($request['reject-booking'])) {
            $booking->status = self::STATUS_REJECTED;
        }

        return $booking->save();
    }

}