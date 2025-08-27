<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class RadioController extends Controller
{
   public function index()
    {
        $statusUrl = 'http://127.0.0.1:8000/status-json.xsl';
        $response = Http::get($statusUrl);
        $data = $response->json();

        $listeners = 0;
        $title = "Nenhuma música tocando";
        $maxClients = 100; // deve ser igual ao icecast.xml

        if(isset($data['icestats']['source'][0])) {
            $source = $data['icestats']['source'][0];
            $listeners = $source['listeners'] ?? 0;
            $title = $source['title'] ?? "Nenhuma música tocando";
        }

        if($listeners >= $maxClients) {
            return view('waiting', ['current' => $listeners, 'max' => $maxClients]);
        }

        return view('radio', ['title' => $title, 'listeners' => $listeners]);
    }

    public function status()
    {
        $statusUrl = 'http://127.0.0.1:8000/status-json.xsl'; // Substitua pelo seu Icecast
        $response = Http::get($statusUrl);
        $data = $response->json();

        $listeners = 0;
        $title = "Nenhuma música tocando";

        if(isset($data['icestats']['source'][0])) {
            $source = $data['icestats']['source'][0];
            $listeners = $source['listeners'] ?? 0;
            $title = $source['title'] ?? "Nenhuma música tocando";
        }

        return response()->json([
            'listeners' => $listeners,
            'title' => $title,
            'stream_url' => 'http://127.0.0.1:8000/stream.mp3'
        ]);
    }
}
