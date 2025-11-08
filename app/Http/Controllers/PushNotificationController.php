<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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

        return response()->json([
            'success' => true,
            'message' => 'Подписка успешно сохранена'
        ]);
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'url' => 'nullable|url',
        ]);

        $payload = [
            'title' => $request->title,
            'body' => $request->body,
            'icon' => url('/storage/img/icon.png'),
            'url' => $request->url ?? url('/'),
        ];

        $results = $this->sendToAllSubscribers($payload);

        return response()->json([
            'success' => true,
            'sent' => count(array_filter($results, fn($r) => $r['success'])),
            'results' => $results
        ]);
    }

    public function getVapidPublicKey()
    {
        // Фиктивный ключ для тестирования
        return response()->json([
            'publicKey' => 'BIx7yZ9uQJ_vnqVjdw9qg3VkfJgYJ2q9w6vK8y6j3X4e1rT5qW8wL2mK6vJ7tH1fY3cR8wZ5qL9tG2vX6'
        ]);
    }

    private function sendToAllSubscribers($payload)
    {
        $subscriptions = $this->getSubscriptions();
        $results = [];

        foreach ($subscriptions as $subscription) {
            $result = $this->sendPushMessage($subscription, $payload);
            $results[] = $result;

            // Удаляем нерабочие подписки
            if (!$result['success']) {
                $this->removeSubscription($subscription['endpoint']);
            }
        }

        return $results;
    }

    private function sendPushMessage($subscription, $payload)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'key=' . env('FCM_SERVER_KEY', ''),
                'Content-Type' => 'application/json',
            ])->post($subscription['endpoint'], [
                'notification' => [
                    'title' => $payload['title'],
                    'body' => $payload['body'],
                    'icon' => $payload['icon'],
                    'click_action' => $payload['url'],
                ],
                'to' => $this->extractFcmToken($subscription['endpoint'])
            ]);

            return [
                'endpoint' => $subscription['endpoint'],
                'success' => $response->successful(),
                'status' => $response->status()
            ];

        } catch (\Exception $e) {
            return [
                'endpoint' => $subscription['endpoint'],
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    private function extractFcmToken($endpoint)
    {
        // Извлекаем FCM token из endpoint
        if (preg_match('/https:\/\/fcm\.googleapis\.com\/fcm\/send\/(.*)/', $endpoint, $matches)) {
            return $matches[1];
        }
        return $endpoint;
    }

    private function saveSubscription($subscription)
    {
        $subscriptions = cache('push_subscriptions', []);
        $subscriptions[] = $subscription;
        cache(['push_subscriptions' => $subscriptions], now()->addDays(30));
    }

    private function getSubscriptions()
    {
        return cache('push_subscriptions', []);
    }

    private function removeSubscription($endpoint)
    {
        $subscriptions = $this->getSubscriptions();
        $subscriptions = array_filter($subscriptions, function($sub) use ($endpoint) {
            return $sub['endpoint'] !== $endpoint;
        });
        cache(['push_subscriptions' => array_values($subscriptions)]);
    }
}
