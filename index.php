<?php

include_once('config.php');

// -------------------- SALVAR NOTAS ----------------------

if(isset($_POST['nota']) && isset($_POST['ocasiao'])){

    $mensagem = filter_input(INPUT_POST, 'nota', FILTER_SANITIZE_SPECIAL_CHARS);

    $data_mensagem = $_POST['ocasiao'];


    $result = mysqli_query($conexao, "INSERT INTO mensagens(mensagem,data) VALUES ('$mensagem','$data_mensagem')");
}

//----------------------------- APAGAR NOTAS ---------------------

if(isset($_POST['deletar'])){
    $nota_apagar = filter_input(INPUT_POST, 'deletar', FILTER_SANITIZE_SPECIAL_CHARS);

    $pesquisa = "DELETE FROM mensagens WHERE mensagem = '{$nota_apagar}'";

    $deletar = $conexao -> query($pesquisa);
    
}

// -------------- CARREGAR MENSAGENS DO BANCO DE DADOS ---------

$msg_sql = "SELECT * FROM `mensagens`";

$resultado2 = $conexao -> query($msg_sql);

$contia = 0;

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
            height: 280px;
            border-radius: 10px;
            background-color: white;
            display: inline-block;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            border: 1.5px solid black;
            position: relative;
            overflow-x: hidden;
            overflow-y: hidden;
            font-size: 1em;
            font-family: monospace;
        }

        .nota-bd:hover{
            box-shadow: 0px 0px 10px rgba(120, 139, 255, 0.5);
        }

        .icon-bin, #alterou{
            position: absolute;
            right: 5px;
            bottom: 5px;
            cursor: pointer;
        }

        #alterou{
            display: none;
        }

        .icon-pencil{
            position: absolute;
            right: 30px;
            bottom: 5px;
            cursor: pointer;
        }

        .editar{
            margin: 0;
            padding: 0;
            position: absolute;
            z-index: 10;
            width: 200px;
            background-color: #004570;
            color: white;
            padding: 3px 2px 1px 0px;
            border-radius: 0px 0px 0px 10px;
            display: none;
            left: 0;
            bottom: -22px;
            text-align: center;
        }

        .editar abbr{
            text-decoration: none;
        }

        .editar li{
            list-style-type: none;
            float: right;
            margin: 0px 3px 0px 3px;
            cursor: pointer;
        }

        .surgir{
            animation: surgindo .8s forwards ease;
        }

        @keyframes surgindo {
            0%{
                transform: translateY(-25%);
            }
            100%{
                transform: translateY(-100%);
            }
        }

        .fechar_editar{
            position: absolute;
            right: 30px;
            bottom: 5px;
            cursor: pointer;
            color: red;
            transform: rotate(45deg);
            font-size: 1em;
            animation: metadinha .7s forwards ease;
        }

        @keyframes metadinha {
            from{
                transform: rotate(0deg);
            }

            to{
                transform: rotate(45deg);
            }
        }

    </style>

</head>
<body class="corpo">
    <ul class="editar" contenteditable="false">
            <li><abbr title="Alinhar à Direita"><span class="icon-paragraph-right" id="alinhar_direita"></span></abbr></li>
            <li><abbr title="Alinhar no Centro"><span class="icon-paragraph-center" id="alinhar_centro"></span></abbr></li>
            <li><abbr title="Justificar"><span class="icon-paragraph-justify" id="justificar"></span></abbr></li>
            <li><abbr title="Alinhar à Esquerda"><span class="icon-paragraph-left" id="alinhar_esquerda"></span></abbr></li>
            <li><abbr title="Sublinhado"><span class="icon-underline" id="sublinhado"></span></abbr></li>
            <li><abbr title="Tachado"><span class="icon-strikethrough" id="tachado"></span></abbr></li>
            <li><abbr title="Itálico"><span class="icon-italic" id="italico"></span></abbr></li>
            <li><abbr title="Negrito"><span class="icon-bold" id="negrito"></span></abbr></li>
    </ul>
    <abbr title="Remover Rascunho"><span class="icon-plus cancelar xis1"></span></abbr>
    <abbr title="Remover Rascunho"><span class="icon-plus cancelar xis2"></span></abbr>
    <abbr title="Remover Rascunho"><span class="icon-plus cancelar xis3"></span></abbr>
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
        <abbr title=""><span></span></abbr>
    <footer class="carregar-msg" style="display: none; width: 100vw;">
        <?php while($dados = mysqli_fetch_assoc($resultado2))
                {
                    echo '<p class="nota-bd" id="geradas">';
                    echo html_entity_decode($dados['mensagem']);

                    echo '<abbr title="Editar"><span><span class="icon-pencil"></span><span></abbr><abbr title="Apagar"><span class="icon-bin" id="lixo"></span></abbr><abbr title="Alterar"><span class="icon-checkmark" id="alterou"></span></abbr>';
                    echo '</p>';
                } ?>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script>
        const footer = document.querySelector('.carregar-msg');
        const identificar_quadro = document.querySelector('.identificar-container');
        const lixeira = document.getElementById("lixo");
        const bodycego = document.querySelector('.corpo');
        const alterar = document.getElementById("alterou");
        numei = 0;

        //-------------- EXEC COMMAND ------------

        const alinhar_centro = document.getElementById("alinhar_centro");
        const alinhar_esquerda = document.getElementById("alinhar_esquerda");
        const justificar = document.getElementById("justificar");
        const alinhar_direita = document.getElementById("alinhar_direita");
        const sublinhado = document.getElementById("sublinhado");
        const tachado = document.getElementById("tachado");
        const italico = document.getElementById("italico");
        const negrito = document.getElementById("negrito");

        //----------------- CARREGAR NOTAS ------------------

        document.addEventListener("mousemove",revelar_notas)

        function revelar_notas(){
            if(identificar_quadro.style.display == 'none'){
                footer.style.display = 'block';
            }
            else{
                footer.style.display = 'none';
            }
        }

        //-------------------------- APAGAR NOTA ----------------------

        document.addEventListener('click',function(e){
            if(e.path[2] == '[object HTMLParagraphElement]'){

                var confirmar = confirm('deseja realmente apagar essa nota?');
                if(confirmar == true){
                    // alert(e.path);
                    // alert(e.path[2].innerHTML)

                    var msg_delete = e.path[2].innerHTML;

                    separe = new RegExp('<abbr title="Editar"><span><span class="icon-pencil"></span><span></span></span></abbr><abbr title="Apagar"><span class="icon-bin" id="lixo"></span></abbr>', 'i');

                    var reciclar = msg_delete.replace(separe, '');


                    var dados = new FormData();

                    dados.append('deletar', reciclar);

                    $.ajax({
                    url: 'index.php',
                    method: 'post',
                    data: dados,
                    processData: false,
                    contentType: false,
                    success: function(resposta){
                        console.log('O AJAX FOI ENVIADO');
                    }
                    })

                    location.reload();
                    location.reload();
                    location.reload();
                    location.reload();
                }
            }
        })

        //---------------------------- EDITAR NOTA -------------------

        document.addEventListener('click',function(e){

            if(e.path[3] == '[object HTMLParagraphElement]'){

                const btns = document.querySelector('.editar');
                const nota_carregada = document.querySelector('.nota-bd');
                const lapis = e.path[0];
                numei++;

                if(numei == 1){

                    if(numei == 1 && e.path[3].contentEditable == 'true' && e.path[3].designMode == 'on'){
                        alert('Altere somente uma nota por vez!');
                        numei = 1;
                    }
                    else{

                        e.path[3].contentEditable = 'true';
                        e.path[3].designMode = 'on';

                        btns.style.display = 'inline-block';
                        
                        e.path[3].insertAdjacentElement('beforeend',btns);

                        btns.classList.add('surgir');

                        lapis.classList.remove('icon-pencil');
                        lapis.classList.add('icon-plus');
                        lapis.classList.add('fechar_editar');
                        e.path[2].title = 'Cancelar';
                        lixeira.style.display = 'none';
                        alterar.style.display = 'inline-block';
                    }

                    negrito.addEventListener('click', bold)

                    var bold = function(){
                        e.path[3].innerHTML.execCommand('bold', false, null);
                    }
                }

                if(numei == 2){

                    if(numei == 2 && e.path[3].contentEditable == 'false' && e.path[3].designMode == 'off'){
                        alert('Altere somente uma nota por vez!');
                        numei = 2;
                    }
                    else{
                        e.path[3].contentEditable = 'false';
                        e.path[3].designMode = 'off';
                        btns.style.display = 'none';
                        btns.classList.remove('surgir');
                        e.path[2].title = 'Editar';

                        lapis.classList.remove('fechar_editar');
                        lapis.classList.remove('icon-plus');
                        lapis.classList.add('icon-pencil');
                        numei = 0;
                        lixeira.style.display = 'inline-block';
                        alterar.style.display = 'none';
                        lapis.style = 'font-size: 1em';
                    }
                }

            }

        })
    </script>
</body>
</html>