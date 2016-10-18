<?php

namespace App\Http\Controllers\Bookings;

use App\Models\Booking;
use App\Models\BookingSettings;
use Validator;
use App\Http\Controllers\Bookings\BaseBookingController;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use App\Core\Traits\BookingTrait;
use App\Services\Transformers\BookingTransformer;

class BookingController extends BaseBookingController
{
    use BookingTrait;

    /**
     * Updates the booking settings
     *
     * @author Response
     */
    public function update($id)
    {
        $result = $this->updateBooking($id);

        if ($result) {
            return $this->respondUpdated("Booking Item successfully updated");
        }
    }
}
