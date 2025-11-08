<?php
// app/Console/Commands/GenerateVapidKeys.php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateVapidKeys extends Command
{
    protected $signature = 'vapid:generate';
    protected $description = 'Generate VAPID keys for push notifications';

    public function handle()
    {
        // Генерируем ключи используя OpenSSL напрямую
        $keyPair = openssl_pkey_new([
            "digest_alg" => "sha256",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_EC,
            "curve_name" => "prime256v1"
        ]);

        if (!$keyPair) {
            $this->error('Не удалось сгенерировать ключи. Проверьте поддержку OpenSSL в вашей системе.');
            return 1;
        }

        // Извлекаем приватный ключ
        $privateKey = '';
        openssl_pkey_export($keyPair, $privateKey);

        // Получаем детали ключа
        $keyDetails = openssl_pkey_get_details($keyPair);
        $publicKey = $keyDetails['key'];

        // Конвертируем в формат для VAPID
        $vapidKeys = [
            'publicKey' => $this->convertKeyToVapidFormat($publicKey, 'public'),
            'privateKey' => $this->convertKeyToVapidFormat($privateKey, 'private')
        ];

        $this->info('VAPID Keys generated successfully!');
        $this->line('Public Key: ' . $vapidKeys['publicKey']);
        $this->line('Private Key: ' . $vapidKeys['privateKey']);

        $this->info("\nAdd these to your .env file:");
        $this->line("VAPID_PUBLIC_KEY={$vapidKeys['publicKey']}");
        $this->line("VAPID_PRIVATE_KEY={$vapidKeys['privateKey']}");

        return 0;
    }

    private function convertKeyToVapidFormat($key, $type)
    {
        if ($type === 'public') {
            // Извлекаем публичный ключ в сыром формате
            $details = openssl_pkey_get_details(openssl_pkey_get_public($key));
            $x = $details['ec']['x'];
            $y = $details['ec']['y'];

            // Создаем необработанный публичный ключ
            $rawPublicKey = "\x04" . $x . $y;

            return $this->base64urlEncode($rawPublicKey);
        } else {
            // Для приватного ключа извлекаем сырые данные
            $details = openssl_pkey_get_details(openssl_pkey_get_private($key));
            $privateKey = $details['ec']['d'];

            return $this->base64urlEncode($privateKey);
        }
    }

    private function base64urlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
