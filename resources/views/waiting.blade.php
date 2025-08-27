<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Rádio Lotada</title>
<style>
body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background: #f5f5f5; }
h1 { color: #d9534f; }
</style>
</head>
<body>
<h1>Ops! A rádio está lotada 😅</h1>
<p>Ouvintes atuais: {{ $current }} / {{ $max }}</p>
<p>Por favor, aguarde na fila...</p>

<script>
// Recarrega a página a cada 10 segundos para tentar entrar
setTimeout(() => location.reload(), 10000);
</script>

</body>
</html>
