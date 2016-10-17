<?php

namespace App\Http\Controllers\Admin\Bookings;

use App\Models\Booking;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use App\Services\Transformers\BookingTransformer;

class BookingController extends Controller
{
    const STATUS_PENDING = 'pending';

    const STATUS_CONFIRMED = 'confirmed';

    const STATUS_REJECTED = 'rejected';

    const STATUS_CANCELLED = 'cancelled';

    public function __construct(Request $request, BookingTransformer $transformer)
    {
        $this->request = $request;
        $this->setTransformer($transformer);
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

    // Getters and Setters

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
        $request = $this->request->all();

        $booking = Booking::where('uid', $id)->first();

        $booking->email = $request['email'];
        $booking->name = $request['name'];
        $booking->date = $request['date'];
        $booking->time = $request['time'];
        $booking->size = $request['size'];
        $booking->telephone = $request['telephone'];
        $booking->status = self::STATUS_PENDING;

        if (isset($request['confirm-booking'])) {
            $booking->status = self::STATUS_CONFIRMED;
        }

        if (isset($request['cancel-booking'])) {
            $booking->status = self::STATUS_CANCELLED;
        }

        if (isset($request['reject-booking'])) {
            $booking->status = self::STATUS_REJECTED;
        }

        if ($booking->save()) {
            return redirect()
                ->route('viewBooking', [
                    'id' => $booking->uid
                ])
                ->with("success", "Booking has been updated.");
        }
    }
}
