<?php

namespace App\Http\Controllers\Bookings;

use App\Models\Booking;
use App\Models\BookingSettings;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Transformers\BookingSettingsTransformer;

class BookingSettingsController extends Controller
{
    public function __construct(Request $request, BookingSettingsTransformer $transformer)
    {
        $this->request = $request;
        $this->setTransformer($transformer);
    }

    /**
     * Retrieve settings - always assigned to the first row
     *
     * @return Response
     */
    public function get()
    {
        $settings = BookingSettings::find(1);

        $data = $this->transform($settings);

        return $this->respond($data, 202);
    }
}
