<?php

namespace App\Http\Controllers\Admin\Bookings;

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

    public function view()
    {
        $this->addScript('components/booking-settings.js');

        $this->setPageTitle("Booking Settings");

        return $this->loadViewWithScripts('backend.booking.settings');
    }

    public function get()
    {
        $settings = BookingSettings::find(1);

        $data = $this->transform($settings);

        return $this->respond($data, 200);
    }

    public function update()
    {
        $request = $this->request->all();

        $settings = BookingSettings::firstOrNew(['id' => 1]);

        $settings->time_allocation = $request['time_allocation'];
        $settings->opening_time = $request['opening_time'];
        $settings->closing_time = $request['closing_time'];
        $settings->seats = $request['seats'];
        $settings->email = $request['email'];

        $settings->save();

        return redirect('backend/booking/settings/view')->with("success", "Settings are all updated now.");
    }
}
