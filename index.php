<?php

include_once('config.php');

// -------------------- SALVAR NOTAS ----------------------

if(isset($_POST['nota']) && isset($_POST['ocasiao'])){

    $mensagem = filter_input(INPUT_POST, 'nota', FILTER_SANITIZE_SPECIAL_CHARS);

    $data_mensagem = $_POST['ocasiao'];


    $result = mysqli_query($conexao, "INSERT INTO mensagens(mensagem,data) VALUES ('$mensagem','$data_mensagem')");
}

// -------------- CARREGAR MENSAGENS DO BANCO DE DADOS ---------

$msg_sql = "SELECT * FROM `mensagens`";

$resultado2 = $conexao -> query($msg_sql);

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

    <style>
        .nota-bd{
            padding: 10px;
            margin-bottom: 10px;
            margin: 20px 10px 20px 10px;
            width: 430px;
            height: 350px;
            border-radius: 10px;
            background-color: white;
            display: inline-block;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            border: 1px solid rgb(0, 68, 110);
            position: relative;
            overflow: hidden;
        }

        .nota-bd:hover{
            background-color: transparent;
            cursor: grab;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            color: white;
            border: 1px solid white;
        }

        .icon-bin{
            position: absolute;
            right: 5px;
            bottom: 5px;
            cursor: pointer;
        }

        .icon-pencil{
            position: absolute;
            right: 30px;
            bottom: 5px;
            cursor: pointer;
        }
    </style>

</head>
<body class="corpo">
    <?php if(isset($_COOKIE['entrou']))
        {
            echo '<output class="entrou1" style="display: none;">1</output>';
        } ?>
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
            <input class="pesquisa" type="search" name="pesquisa" id="ipesquisa-1" placeholder="Pesquisa" >
            <div id="icone"><span class="icon-search"></span></div>
            <a href="#" class="config"><span class="icon-cog"></span></a>
        </nav>
    </header>
    <div class="btn-nova"><span class="icon-plus nova"></span></div>
    
    <main class="caderno">

    </main>

    <footer class="carregar-msg" style="display: none; width: 100vw;">
        <?php while($dados = mysqli_fetch_assoc($resultado2))
                {
                    echo '<p class="nota-bd" id="geradas">';
                    echo html_entity_decode($dados['mensagem']);
                    echo '<span class="icon-pencil"></span><span class="icon-bin"></span>';
                    echo '</p>';
                } ?>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script>
        const footer = document.querySelector('.carregar-msg');
        const identificar_quadro = document.querySelector('.identificar-container');

        document.addEventListener("mousemove",revelar_notas)

        function revelar_notas(){
            if(identificar_quadro.style.display == 'none'){
                footer.style.display = 'block';
            }
            else{
                footer.style.display = 'none';
            }
        }


    </script>
</body>
</html>