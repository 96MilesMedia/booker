<?php

namespace App\Services\Transformers;

use App\Core\Contracts\TransformerInterface;
use App\Models\Booking;
use League\Fractal\TransformerAbstract;

class BookingTransformer extends TransformerAbstract implements TransformerInterface
{
    public function transform($booking)
    {
        return [
            'uid'       => $booking->uid,
            'email'     => $booking->email,
            'name'      => $booking->name,
            'date'      => $booking->date,
            'time'      => $booking->time,
            'size'      => $booking->size,
            'telephone' => $booking->telephone,
            'status'    => $booking->status
        ];
    }
}
