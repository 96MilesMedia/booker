<?php

namespace App\Http\Controllers\Admin\Bookings;

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

    public function bookingsByDate()
    {
        $request = $this->request->all();

        if (!$request['date']) {
            throw \Exception("A date parameter is required");
        }

        $date = $request['date'];

        $this->setPageTitle("Bookings for: " . date('jS F Y', strtotime($date)));

        $this->pageAttributes['date'] = date('Y-m-d', strtotime($date));

        $this->addScript('components/booking-manage.js');

        return $this->loadViewWithScripts('backend.booking.date-list');
    }

    /**
     * Controller view for adding a new booking
     *
     * @return  response
     */
    public function add()
    {
        $this->addScript('components/booking-form.js');

        $this->setPageTitle("New Booking");

        return $this->loadViewWithScripts('backend.booking.add');
    }

    /**
     * Controller view for getting a specific booking
     *
     * @return  response
     */
    public function view($id)
    {
        $booking = Booking::where('uid', $id)->first();

        $this->addScript('components/booking-form.js');

        $this->setPageTitle("Booking: " . $booking->name);

        $data = [
            'booking' => $this->transform($booking)
        ];

        return $this->loadViewWithScripts('backend.booking.manage', $data);
    }

    /**
     * Controller view for displaying all bookings
     *
     * @return  response
     */
    public function index()
    {
        $this->setPageTitle("Bookings");

        $this->addScript('components/bookings.js');

        return $this->loadViewWithScripts('backend.booking.index');
    }

    // ------------------------
    //
    // Getters and Setters
    //
    // ------------------------

    public function all()
    {
        $bookings = new Booking;

        $request = $this->request->all();

        if (isset($request)) {
            foreach ($request as $key => $value) {
                $bookings = $bookings->where($key, '=', $value);
            }
        }

        $bookings = $bookings->get();

        $data = $this->transform($bookings);

        return $this->respond($data, 200);
    }

    /**
     * Rather than using the all route this is a very specific
     * case for getting only bookings by a date that
     * are confirmed and completed so it requires a sub query
     *
     * @param  string $date
     * @return collection
     */
    public function getBookingsByDate($date)
    {
        $model = new Booking();

        $bookings = $model->where('date', '=', $date)
                          ->where(function ($query) {
                              return $query->where('status', '=', self::STATUS_CONFIRMED)
                                         ->orWhere('status', '=', self::STATUS_COMPLETED);
                          })
                          ->orderBy('time', 'ASC')
                          ->get();

        $data = $this->transform($bookings);

        return $this->respond($data, 200);
    }

    /**
     * @todo - Move into trait for shared api
     */
    public function create()
    {
        $booking = new Booking;

        $request = $this->request->all();

        $booking->uid = Uuid::generate();
        $booking->email = $request['email'];
        $booking->name = $request['name'];
        $booking->date = $request['date'];
        $booking->time = $request['time'];
        $booking->size = $request['size'];
        $booking->telephone = $request['telephone'];
        $booking->status = self::STATUS_PENDING;

        if ($booking->save()) {
            return redirect()
                ->route('viewBooking', [
                    'id' => $booking->uid
                ])
                ->with("success", "New Booking has been created.");
        }
    }

    public function delete($id)
    {
        $booking = Booking::where('uid', $id)->first();

        $booking->delete();

        return $this->respondUpdated("Booking Item successfully deleted");
    }

    /**
     * Updates the booking settings
     *
     * @author Response
     */
    public function update($id)
    {
        $result = $this->updateBooking($id);

        if ($result) {
            return redirect()
                ->route('viewBooking', [
                    'id' => $booking->uid
                ])
                ->with("success", "Booking has been updated.");
        }
    }
}
