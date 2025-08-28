# RetroPlay Radio 🎶📻

Este projeto é uma aplicação Laravel que integra um servidor **Icecast** para streaming de áudio e exibe informações em tempo real, como número de ouvintes e música em reprodução.

---

## 🚀 Funcionalidades

* Player integrado para escutar o stream do Icecast.
* Exibição do **título da música** em reprodução.
* Exibição da quantidade de **ouvintes simultâneos**.
* API (`/api/radio/status`) que retorna status do servidor Icecast:

  ```json
  {
    "listeners": 1,
    "title": "Nome da música",
    "stream_url": "http://retroplayradio.rondodev.com.br:8000/stream.mp3"
  }
  ```

---

## 📦 Requisitos

* PHP 8.2+
* Composer
* Node.js 18+
* NPM ou Yarn
* Banco de dados SQLite (ou outro suportado pelo Laravel)
* Icecast 2.4+
* FFMPEG

---

## ⚙️ Instalação do Projeto (Laravel)

Clone o repositório e instale as dependências:

```bash
git clone https://github.com/seuusuario/retroplay-radio.git
cd retroplay-radio

# Instalar dependências PHP
composer install

# Instalar dependências JS
npm install && npm run build

# Configurar variáveis de ambiente
cp .env.example .env

# Gerar chave do Laravel
php artisan key:generate
```

Edite o arquivo `.env` e configure conforme necessário.

---

## 🎵 Configuração do Icecast (Linux)

### Instalar Icecast

No Ubuntu/Debian:

```bash
sudo apt update
sudo apt install icecast2 -y
```

Durante a instalação, defina:

* Senha de administrador
* Senha de relay
* Senha de source (importante para o FFMPEG enviar áudio)

Os arquivos de configuração ficam em:

```
/etc/icecast2/icecast.xml
```

Edite esse arquivo para ajustar:

* Porta do servidor (exemplo: `8000`)
* Nome do mountpoint (`/stream.mp3`)
* Senhas (admin/source/relay)

Após configurar:

```bash
sudo systemctl enable icecast2
sudo systemctl start icecast2
```

O status pode ser acessado em:

```
http://seu-dominio:8000/status-json.xsl
```

---

## 🎤 Enviando áudio com FFMPEG

Você pode transmitir músicas ou playlists diretamente para o Icecast.

### Instalar FFMPEG

```bash
sudo apt install ffmpeg -y
```

### Enviar um arquivo de música para o Icecast

```bash
ffmpeg -re -i sua-musica.mp3 -acodec libmp3lame -content_type audio/mpeg \
f "icecast://source:SENHA@localhost:8000/stream.mp3"
```

* `sua-musica.mp3` → Arquivo de áudio
* `source:SENHA` → Usuário e senha configurados no `icecast.xml`
* `stream.mp3` → Mountpoint configurado

### Transmitir uma playlist

```bash
ffmpeg -re -i "playlist.m3u" -acodec libmp3lame -content_type audio/mpeg \
f "icecast://source:SENHA@localhost:8000/stream.mp3"
```

Agora o stream estará disponível em:

```
http://seu-dominio:8000/stream.mp3
```

---

## 🌐 API Laravel

A API que consulta o Icecast está disponível em:

```
GET /api/radio/status
```

Exemplo de resposta:

```json
{
  "listeners": 5,
  "title": "Música Atual",
  "stream_url": "http://seu-dominio:8000/stream.mp3"
}
```

Essa rota utiliza a função `status()` do **RadioController** para buscar os dados de:

```
http://icecast:8000/status-json.xsl
```

---

## 🎧 Player no Frontend

O frontend busca a API a cada 5 segundos e atualiza:

```javascript
const player = document.getElementById('radioPlayer');
player.volume = 0.1;

async function fetchStatus() {
    const res = await fetch('/api/radio/status');
    const data = await res.json();
    document.getElementById('title').innerText = data.title;
    document.getElementById('listeners').innerText = data.listeners;
}
setInterval(fetchStatus, 5000);
fetchStatus();
```

---

## 📄 Licença

Este projeto é distribuído sob a licença MIT.
Sinta-se livre para contribuir e melhorar! 🚀
