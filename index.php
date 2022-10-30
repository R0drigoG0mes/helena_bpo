<?php

include_once('config.php');

if(isset($_POST['nota']) && isset($_POST['ocasiao'])){

    $mensagem = $_POST['nota'];
    $data_mensagem = $_POST['ocasiao'];

    $result = mysqli_query($conexao, "INSERT INTO mensagens(mensagem,data) VALUES ('$mensagem','$data_mensagem')");
}

// -------------- CARREGAR MENSAGENS DO BANCO DE DADOS ---------

$sql = "SELECT * FROM `mensagens`";

$result = $conexao -> query($sql);

$numero_mensagens = mysqli_num_rows($result);

$dados = $result ->fetch_array();

print_r($result);

function escrever_anotacoes(){
    foreach($result as $linha){
        $texto = '<p class="nota-bd">{$linha}</p>';
        echo $texto; 
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="author" content="Rodrigo Gomes Cordeiro">
    <meta name="description" content="Site de anotações para o setor de BPO">
    <meta name="keywords" content="BPO, Anotações, RH, Recursos Humanos">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="icones/style.css">
    <link rel="stylesheet" href="icones/cadeado/style.css">
    <script src="js/script.js" defer></script>
    <title>Anotações Comitê</title>
</head>
<body class="corpo">
    <span class="icon-plus cancelar xis1"></span>
    <span class="icon-plus cancelar xis2"></span>
    <span class="icon-plus cancelar xis3"></span>
    <div class="identificar-container">
        <p class="titulo-identificar">Senha</p>
        <div class="cadeado">
            <span class="icon-lock"></span>
        </div>
            <input type="password" name="identificar" id="identificar" class="identifica" required autocomplete="current-password" tabindex="0">
            <input type="submit" value="Enviar" name="enviar" class="envia">
    </div>
    <header class="header">
        <nav class="nav">
            <label for="ipesquisa" class="label-pesquisa">Pesquise Aqui</label>
            <input class="pesquisa" type="search" name="pesquisa" id="ipesquisa" placeholder="Pesquisa" >
            <div id="icone"><span class="icon-search"></span></div>
            <a href="#" class="config"><span class="icon-cog"></span></a>
        </nav>
    </header>
    <div class="btn-nova"><span class="icon-plus nova"></span></div>
    <main class="caderno">

    </main>
    <footer class="carregar-msg">
    <?php  escrever_anotacoes(); ?>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</body>
</html>