<?php

namespace App\Http\Controllers\Bookings;

use App\Models\Booking;
use App\Models\BookingSettings;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use App\Core\Traits\BookingTrait;
use App\Services\Transformers\BookingTransformer;

class BaseBookingController extends Controller
{
    use BookingTrait;

    const STATUS_PENDING = 'pending';

    const STATUS_CONFIRMED = 'confirmed';

    const STATUS_REJECTED = 'rejected';

    const STATUS_CANCELLED = 'cancelled';

    const STATUS_COMPLETED = 'completed';

    public function __construct(Request $request, BookingTransformer $transformer)
    {
        $this->request = $request;
        $this->setTransformer($transformer);
    }
}
