<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = 'Hello!';

        $client = new Client();
        $url = 'https://api.openai.com/v1/chat/completions';
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ];
        $body = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [['role' => 'user', 'content' => $message]],
        ];
        $response = $client->post($url, [
            'headers' => $headers, 
            'json' => $body,
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return response()->json($result['choices'][0]['message']['content']);
    }
}
