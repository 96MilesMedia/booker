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
use App\Services\Booking\Exceptions\CreateBookingException;
use App\Services\Booking\Exceptions\UpdateBookingException;

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
        $this->setPageTitle("Booking Management");

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
     * @todo - Move into trait for shared api
     */
    public function create()
    {
        if ($booking = $this->createBooking()) {
            return redirect()
                ->route('viewBooking', [
                    'id' => $booking->uid
                ])
                ->with("success", "New Booking has been created.");
        } else {
            throw new CreateBookingException("There was a problem creating booking");
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
                    'id' => $id
                ])
                ->with("success", "Booking has been updated.");
        } else {
            throw new UpdateBookingException("There was a problem updating the booking");
        }
    }
}
