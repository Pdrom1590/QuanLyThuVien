<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PickupReminder;
use App\Notifications\PickupMissed;

class NotificationController extends Controller
{
    public function sendPickupReminders()
    {
        $orders = Order::where('pickup_date', '<=', now()->addDay())
            ->where('status', 'pending')
            ->get();

        foreach ($orders as $order) {
        }

        return response()->json(['message' => 'Reminders sent successfully.']);
    }

    public function handleMissedPickups()
    {
        $orders = Order::where('pickup_date', '<', now())
            ->where('status', 'pending')
            ->get();

        foreach ($orders as $order) {
            $order->update(['status' => 'missed']);
            $order->product->increment('quantity', $order->quantity);

            Notification::send($order->user, new PickupMissed($order));
            Notification::send($order->product->user, new PickupMissed($order));
        }

        return response()->json(['message' => 'Missed pickups handled successfully.']);
    }
}