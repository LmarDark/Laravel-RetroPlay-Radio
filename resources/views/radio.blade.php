<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Minha Rádio Online</title>
<style>
  body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background: #f5f5f5; }
  #player { margin-top: 20px; }
  #info { margin-top: 10px; font-size: 18px; }
</style>
</head>
<body>
<h1>Minha Rádio Online</h1>

<div id="player">
    <audio autoplay loop id="radioPlayer">
        <source src="https://retroplayradio.rondodev.com.br/stream/stream.mp3" type="audio/mpeg">
    </audio>
</div>

<div id="info">
    <div><strong>Música atual:</strong> <span id="title">Carregando...</span></div>
    <div><strong>Ouvintes:</strong> <span id="listeners">0 Ouvintes</span></div>
</div>

<script>
const player = document.getElementById('radioPlayer');
player.volume = 0.1;

async function fetchStatus() {
    try {
        const res = await fetch('/api/radio/status');
        const data = await res.json();
        document.getElementById('title').innerText = data.title;
        document.getElementById('listeners').innerText = data.listeners;
    } catch (e) {
        console.error("Erro ao buscar status da rádio:", e);
    }
}

setInterval(fetchStatus, 5000);
fetchStatus();
</script>

</body>
</html>
