<?php

include_once('config.php');

if(isset($_POST['nota']) && isset($_POST['ocasiao'])){

    $mensagem = $_POST['nota'];
    $data_mensagem = $_POST['ocasiao'];

    $result = mysqli_query($conexao, "INSERT INTO mensagens(mensagem,data) VALUES ('$mensagem','$data_mensagem')");
    escrever_anotacoes();
}

// -------------- CARREGAR MENSAGENS DO BANCO DE DADOS ---------

function escrever_anotacoes(){

    $dbHost = 'LocalHost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'comite_bpo';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sql = "SELECT `mensagem` FROM `mensagens`";

    $result = $conexao -> query($sql);

    $numero_mensagens = mysqli_num_rows($result);

    for($linhas = $numero_mensagens; $linhas>0; $linhas--){

        $msg_sql = "SELECT `mensagem` FROM `mensagens` WHERE `id` ={$linhas}";

        $resultado = $conexao -> query($msg_sql);


        echo '<p class="nota-bd" id="geradas">';
        print_r(mysqli_fetch_column($resultado));
        echo '</p>';

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
    <title>Anotações Comitê</title>

    <style>
        .nota-bd{
            padding: 10px;
            margin-bottom: 10px;
            margin-top: 10px;
            margin-left: 50vw;
            transform: translateX(-50%);
            width: 700px;
            height: 100px;
            text-align: center;
            border: 2px solid rgb(0, 68, 110);
            border-radius: 10px;
            background-color: white;
        }
    </style>

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
        <?php if(isset($_POST['senha'])){escrever_anotacoes();}?>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

    <script>
        const btn_senha = document.querySelector('.envia');

        btn_senha.addEventListener('click',revelar_notas)

        function revelar_notas(){

            var identificou = 'sim';

            $.ajax({
                url: 'http://localhost/helena_bpo/index.php',
                method: 'post',
                data: {senha: identificou},
                dataType: 'json'
            }).done(function(result){
                console.log(result);
            });
        }
    </script>
</body>
</html>