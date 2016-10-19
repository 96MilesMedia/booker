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

    /**
     * Rather than using the all route this is a very specific
     * case for getting only bookings by a date that
     * are confirmed and completed so it requires a sub query
     *
     * @param  string $date
     * @param optional boolean $valid
     * @return collection
     */
    public function getBookingsByDate($date, $valid=false)
    {
        $model = new Booking();

        $bookings = $model->where('date', '=', $date);

        // Not the nicest way to do it but if valid is set
        // we want to include pending bookings so we don't
        // get any double bookings
        if (!$valid) {
            $bookings = $bookings->where(function ($query) {
                              return $query->where('status', '=', self::STATUS_CONFIRMED)
                                           ->orWhere('status', '=', self::STATUS_COMPLETED);
                          });
        } else {
            $bookings = $bookings->where(function ($query) {
                              return $query->where('status', '=', self::STATUS_CONFIRMED)
                                           ->orWhere('status', '=', self::STATUS_PENDING)
                                           ->orWhere('status', '=', self::STATUS_COMPLETED);
                          });
        }

        $bookings = $bookings->orderBy('time', 'ASC')
                             ->get();

        $data = $this->transform($bookings);

        return $this->respond($data, 200);
    }
}
