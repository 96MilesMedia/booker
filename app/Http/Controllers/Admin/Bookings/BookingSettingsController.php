<?php

namespace App\Http\Controllers\Admin\Bookings;

use App\Models\BookingSettings;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingSettingsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function update()
    {
        $request = $this->request->all();

        $settings = BookingSettings::firstOrNew(['id' => 1]);

        $settings->time_allocation = $request['time_allocation'];
        $settings->seats = $request['seats'];
        $settings->email = $request['email'];

        $settings->save();

        return redirect('backend/booking/settings')->with("success", "Settings are all updated now.");
    }
}
