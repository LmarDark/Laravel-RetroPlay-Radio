<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class RadioController extends Controller
{
    public function index()
    {
        $statusUrl = 'http://icecast:8000/status-json.xsl';
        $response = Http::get($statusUrl);
        $data = $response->json();

        $listeners = 0;
        $title = "Nenhuma música tocando";
        $maxClients = 100; 
        
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
        $statusUrl = 'http://icecast:8000/status-json.xsl';
        $response = Http::get($statusUrl);
        $data = $response->json();
      
        $listeners = 0;
        $title = "Nenhuma música tocando";

        if (isset($data['icestats']['source'][0])) {
            // Caso com múltiplos sources
            $source = $data['icestats']['source'][0];
            $listeners = $source['listeners'] ?? 0;
            $title = $source['title'] ?? "Nenhuma música tocando";
        } elseif (isset($data['icestats']['source'])) {
            // Caso com único source
            $source = $data['icestats']['source'];
            $listeners = $source['listeners'] ?? 0;
            $title = $source['title'] ?? "Nenhuma música tocando";
        }

        return response()->json([
            'listeners' => $listeners,
            'title' => $title,
            'stream_url' => 'http://icecast:8000/stream.mp3'
        ]);
    }
}
