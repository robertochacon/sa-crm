<?php

namespace App\Http\Controllers\Api\v1\WebSocket;

use App\Http\Controllers\Controller;
use App\Services\WebSocketService;
use Illuminate\Http\Request;

class WebSocketController extends Controller
{
    protected $webSocketService;

    public function __construct(WebSocketService $webSocketService)
    {
        $this->webSocketService = $webSocketService;
    }

    /**
     * Enviar mensaje al servidor WebSocket
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'channel' => 'nullable|string',
        ]);

        $message = $request->input('message');
        $channel = $request->input('channel', 'default');

        $this->webSocketService->sendMessage($message, $channel);

        return response()->json(['status' => 'Mensaje enviado correctamente']);
    }
}
