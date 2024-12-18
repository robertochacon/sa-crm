<?php

namespace App\Services;

use WebSocket\Client;

class WebSocketService
{
    protected $websocketUrl;
    protected $websocketToken;

    public function __construct()
    {
        // URL del servidor WebSocket
        $this->websocketUrl = env('WSS_HOST') ?? 'ws://localhost:8080';
        $this->websocketToken = env('WSS_Key');
    }

    /**
     * Enviar mensaje al WebSocket
     *
     * @param string $message
     * @param string|null $channel
     * @return void
     */
    public function sendMessage(string $message, ?string $channel = 'channel-default'): void
    {
        try {
            // Crear cliente WebSocket
            $client = new Client("{$this->websocketUrl}?token={$this->websocketToken}&channel={$channel}");

            // Enviar mensaje
            $client->send($message);

            // Cerrar la conexión
            $client->close();
        } catch (\Exception $e) {
            // Manejo de errores
            \Log::error('Error enviando mensaje por WebSocket: ' . $e->getMessage());
        }
    }
}
