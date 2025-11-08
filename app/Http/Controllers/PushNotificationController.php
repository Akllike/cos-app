<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PushNotificationController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'endpoint' => 'required|url',
            'keys.auth' => 'required|string',
            'keys.p256dh' => 'required|string',
        ]);

        $subscription = $request->all();
        $this->saveSubscription($subscription);

        Log::info('Новая подписка на push-уведомления', $subscription);

        return response()->json(['success' => true]);
    }

    public function getVapidPublicKey()
    {
        // Возвращаем фиктивный ключ для тестирования
        return response()->json([
            'publicKey' => 'BIx7yZ9uQJ_vnqVjdw9qg3VkfJgYJ2q9w6vK8y6j3X4e1rT5qW8wL2mK6vJ7tH1fY3cR8wZ5qL9tG2vX6'
        ]);
    }

    private function saveSubscription($subscription)
    {
        $subscriptions = cache('push_subscriptions', []);
        $subscriptions[] = $subscription;
        cache(['push_subscriptions' => $subscriptions], now()->addDays(30));
    }
}
