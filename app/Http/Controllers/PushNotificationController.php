<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class PushNotificationController extends Controller
{
    private $vapidKeys;

    public function __construct()
    {
        $this->vapidKeys = [
            'publicKey' => env('VAPID_PUBLIC_KEY'),
            'privateKey' => env('VAPID_PRIVATE_KEY'),
            'subject' => env('VAPID_SUBJECT', 'mailto:admin@shar-cosmetics.ru')
        ];
    }

    /**
     * Сохранить подписку на уведомления
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'endpoint' => 'required|url',
            'keys.auth' => 'required|string',
            'keys.p256dh' => 'required|string',
        ]);

        $subscription = $request->all();
        $this->saveSubscription($subscription);

        Log::info('Новая подписка на push-уведомления', [
            'endpoint' => $subscription['endpoint'],
            'keys' => array_keys($subscription['keys'])
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Подписка успешно сохранена'
        ]);
    }

    /**
     * Отправить уведомление всем подписчикам
     */
    public function sendNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'url' => 'nullable|url',
            'icon' => 'nullable|url',
        ]);

        $payload = [
            'title' => $request->title,
            'body' => $request->body,
            'icon' => $request->icon ?? url('/storage/img/icon.png'),
            'badge' => url('/storage/img/icon.png'),
            'image' => url('/storage/img/wide-1.png'),
            'url' => $request->url ?? url('/'),
            'timestamp' => now()->toISOString()
        ];

        $results = $this->sendToAllSubscribers($payload);

        $successCount = count(array_filter($results, fn($r) => $r['success']));

        return response()->json([
            'success' => true,
            'message' => "Уведомления отправлены. Успешно: {$successCount} из " . count($results),
            'sent' => $successCount,
            'total' => count($results),
            'results' => $results
        ]);
    }

    /**
     * Получить VAPID public key для клиента
     */
    public function getVapidPublicKey()
    {
        return response()->json([
            'publicKey' => $this->vapidKeys['publicKey']
        ]);
    }

    /**
     * Тестовый метод для отправки уведомления
     */
    public function testNotification()
    {
        $payload = [
            'title' => 'ShaR - Тест VAPID 🎉',
            'body' => 'Это тестовое push-уведомление с использованием VAPID ключей!',
            'icon' => url('/storage/img/icon.png'),
            'url' => url('/'),
            'timestamp' => now()->toISOString()
        ];

        $results = $this->sendToAllSubscribers($payload);

        return response()->json([
            'success' => true,
            'message' => 'Тестовое уведомление отправлено',
            'vapid_configured' => !empty($this->vapidKeys['publicKey']),
            'results' => $results
        ]);
    }

    private function sendToAllSubscribers($payload)
    {
        $subscriptions = $this->getSubscriptions();
        $results = [];

        if (empty($subscriptions)) {
            Log::warning('Нет подписчиков для отправки уведомлений');
            return [['success' => false, 'error' => 'No subscribers']];
        }

        $auth = [
            'VAPID' => [
                'subject' => $this->vapidKeys['subject'],
                'publicKey' => $this->vapidKeys['publicKey'],
                'privateKey' => $this->vapidKeys['privateKey'],
            ],
        ];

        $webPush = new WebPush($auth);

        foreach ($subscriptions as $subscription) {
            try {
                $report = $webPush->sendOneNotification(
                    Subscription::create($subscription),
                    json_encode($payload)
                );

                $result = [
                    'endpoint' => $subscription['endpoint'],
                    'success' => $report->isSuccess(),
                    'status' => $report->getResponse() ? $report->getResponse()->getStatusCode() : null
                ];

                if (!$report->isSuccess()) {
                    $result['error'] = $report->getReason();
                    // Удаляем невалидные подписки
                    $this->removeSubscription($subscription['endpoint']);
                }

                $results[] = $result;

            } catch (\Exception $e) {
                $results[] = [
                    'endpoint' => $subscription['endpoint'],
                    'success' => false,
                    'error' => $e->getMessage()
                ];

                Log::error('Ошибка отправки push-уведомления', [
                    'endpoint' => $subscription['endpoint'],
                    'error' => $e->getMessage()
                ]);
            }
        }

        return $results;
    }

    private function saveSubscription($subscription)
    {
        $subscriptions = cache('push_subscriptions', []);

        // Проверяем нет ли уже такой подписки
        $exists = array_filter($subscriptions, function($sub) use ($subscription) {
            return $sub['endpoint'] === $subscription['endpoint'];
        });

        if (empty($exists)) {
            $subscriptions[] = $subscription;
            cache(['push_subscriptions' => $subscriptions], now()->addDays(30));
            Log::info('Подписка сохранена', ['endpoint' => $subscription['endpoint']]);
        } else {
            Log::info('Подписка уже существует', ['endpoint' => $subscription['endpoint']]);
        }
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
        Log::info('Подписка удалена', ['endpoint' => $endpoint]);
    }

    /**
     * Получить статистику подписок
     */
    public function getStats()
    {
        $subscriptions = $this->getSubscriptions();

        return response()->json([
            'total_subscriptions' => count($subscriptions),
            'vapid_configured' => !empty($this->vapidKeys['publicKey']),
            'subscriptions' => array_map(function($sub) {
                return [
                    'endpoint' => $sub['endpoint'],
                    'created' => 'unknown' // Можно добавить дату создания
                ];
            }, $subscriptions)
        ]);
    }
}
