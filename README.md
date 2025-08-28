
# GTA SA Rádio Online

Projeto de uma rádio online inspirada no GTA San Andreas, feita com Laravel.

## Funcionalidades

- Transmissão de áudio online via Icecast.
- Exibe a música atual e o número de ouvintes em tempo real.
- Limite de ouvintes simultâneos, com tela de espera caso a rádio esteja cheia.
- Interface web simples e responsiva.

## Tecnologias

- **Backend:** Laravel (PHP)
- **Frontend:** Blade, HTML, CSS, JavaScript
- **Streaming:** Icecast (esperado em `http://127.0.0.1:8000`)

## Como rodar localmente

1. **Clone o repositório:**
	```bash
	git clone https://github.com/seu-usuario/gta-sa-radio-online.git
	cd gta-sa-radio-online
	```

2. **Instale as dependências:**
	```bash
	composer install
	```

3. **Configure o ambiente:**
	- Copie `.env.example` para `.env` e ajuste as variáveis conforme necessário.
	- Gere a chave da aplicação:
	  ```bash
	  php artisan key:generate
	  ```

4. **Inicie o servidor:**
	```bash
	php artisan serve --port=8080
	```

6. **Certifique-se que o Icecast está rodando em `localhost:8000`** e transmitindo em `/stream.mp3`.

7. **Acesse:**  
	[http://localhost:8080](http://localhost:8080)

## Estrutura de Diretórios

- `app/Http/Controllers/RadioController.php`: Controlador principal da rádio.
- `resources/views/radio.blade.php`: Página principal da rádio.
- `resources/views/waiting.blade.php`: Tela de espera quando a rádio está cheia.
- `routes/web.php`: Rota principal (`/`).
- `routes/api.php`: Endpoint para status da rádio (`/api/radio/status`).
- `playlist/`: Pasta para arquivos de áudio (exemplo incluso).

## API

- `GET /api/radio/status`  
  Retorna JSON com título da música, ouvintes e URL do stream.

## Licença

MIT
