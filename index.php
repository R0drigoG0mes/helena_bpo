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

//---------------------- EDITAR NOTAS -------------------------

if(isset($_POST['novo']) && isset($_POST['antigo'])){
    $velha_nota = $_POST['antigo'];
    $mudar_nota = $_POST['novo'];

    $consulta = "UPDATE `mensagens` SET `mensagem` = '{$mudar_nota}' WHERE `mensagens`.`mensagem` = '{$velha_nota}';";

    $executar_mudança = $conexao -> query($consulta);
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
    <link rel="shortcut icon" href="images/21226126171579090778-128.png" type="image/x-icon">
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
            overflow-wrap: break-word;
            overflow-y: hidden;
            font-size: 1em;
            font-family: consolas;
        }

        .nota-bd:hover{
            box-shadow: 0px 0px 10px rgba(120, 139, 255, 0.5);
            cursor: pointer;
        }

        .icon-bin{
            position: absolute;
            right: 1%;
            bottom: 1%;
            cursor: grab;
            color: white;
            background-color: #004570;
            padding: 6px;
            border-radius: 50%;
        }

        .icon-pencil{
            position: absolute;
            right: 10%;
            bottom: 1%;
            cursor: grab;
            color: white;
            background-color: #004570;
            padding: 6px;
            border-radius: 50%;
        }

    </style>

</head>
<body class="corpo">
    <div class="identificar-container">
        <p class="titulo-identificar">Senha</p>
        <div class="cadeado">
            <span class="icon-lock"></span>
        </div>
            <input type="password" name="identificar" id="identificar" class="identifica" required autocomplete="current-password" tabindex="0">
            <input type="submit" value="Enviar" name="enviar" class="envia" title="Enviar (Enter)">
    </div>
    <header class="header">
        <nav class="nav">
            <label for="ipesquisa" class="label-pesquisa">Pesquise Aqui</label>
            <input class="pesquisa" type="search" name="pesquisa" id="ipesquisa-1" placeholder="Pesquisa" >
            <div id="icone"><span class="icon-search"></span></div>
            <a href="#" class="config" id="opcao"><span class="icon-cog"></span></a>
            <ul class="atributos">
                <li class="lista-t"><b>Tema</b></li>
                <li class="tema" id="azul">Azul</li>
                <li class="tema" id="roxo">Roxo</li>
                <li class="tema" id="degrade">Degradê</li>
                <li class="tema" id="dark">Dark</li>
            </ul>
            <ul class="atributos_2">
                <li class="lista-t"><b>Fonte</b></li>
                <li class="tema" style="font-family: system-ui;" id="systemui">System-ui</li>
                <li class="tema" style="font-family: Arial;" id="arial">Arial</li>
                <li class="tema" style="font-family: Verdana;" id="verdana">Verdana</li>
                <li class="tema" style="font-family: consolas;" id="consolas">Consolas</li>
            </ul>
        </nav>
    </header>

        <div class="btn-nova"><span class="icon-plus nova"></span></div>
    
    <main class="caderno">

    </main>
        <abbr title=""><span></span></abbr>
    <footer class="carregar-msg" style="display: none; width: 100vw;">
        <?php while($dados = mysqli_fetch_assoc($resultado2))
                {
                    echo '<p class="nota-bd" id="geradas" title="Ler Nota">';
                    echo html_entity_decode($dados['mensagem']);
                    echo '<abbr title="Editar"><span><span class="icon-pencil"></span><span></abbr><abbr title="Apagar"><span class="icon-bin" id="lixo"></span></abbr>';
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
        const notas = document.querySelector('.nota-bd');

        //----------------- MUDANÇAS COOKIES ----------------

        const nave = document.querySelector('.nav');
        const testao = document.querySelector('.header');
        const mais = document.querySelector('.btn-nova');


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
                    location.reload();
                    location.reload();
                    location.reload();
                }
            }
        })

        //---------------------------- EDITAR NOTA -------------------

        document.addEventListener('click',function(e){

            if(e.path[3] == '[object HTMLParagraphElement]'){

                const nota_carregada = document.querySelector('.nota-bd');
                const lapis = e.path[0];

                var nota_bruta = e.path[3].innerHTML;

                separe = new RegExp('<abbr title="Editar"><span><span class="icon-pencil"></span><span></span></span></abbr><abbr title="Apagar"><span class="icon-bin" id="lixo"></span></abbr>', 'i');

                var nota_limpa = nota_bruta.replace(separe, '');

                var janela_altera = window.open('janela.html', '_blank', 'width=700px, height=500px')

                var adicao = '<p class="msg-alt" style="display: block">'   + nota_limpa + '</p>';

                janela_altera.addEventListener("load", function(){

                    var todos = janela_altera.document.getElementsByTagName('*');

                    todos[10].innerHTML = nota_limpa;

                    var tela2 = todos[11].contentWindow;


                    // tela2.document.body.style = "overflow-wrap: break-word; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif";
                })
            }

        })

        //--------------- LER NOTA-------------------

            document.addEventListener('click',function(e){
                if(e.path[0] == '[object HTMLParagraphElement]'){
                   var ler_tela = window.open('ler.html', '_blank', 'width=700px, height=500px');

                   ler_tela.addEventListener("load", function(){
                    const filhos = ler_tela.document.getElementsByTagName('*');

                    limpar = new RegExp('<abbr title="Editar"><span><span class="icon-pencil"></span><span></span></span></abbr><abbr title="Apagar"><span class="icon-bin" id="lixo"></span></abbr>', 'i');

                    var leitura = e.path[0].innerHTML.replace(limpar, '');

                    filhos[8].innerHTML = leitura;
                   })
                }

            });

        //-------- MUDANÇAS COOKIES -----------------
        
        //--------------- ROXO ----------------------

        if(document.cookie.includes('roxo')){
            nave.style = 'background-color: #5315b6';
            mais.style = 'background-color: #5315b6';
            var expan = document.querySelectorAll("span");
            var listas = document.querySelectorAll("ul");
            listas[0].style = 'background-color: #5315b6';
            listas[1].style = 'background-color: #5315b6';
            // expan[2].style.color = 'red';

            valori = 5
            while (valori < expan.length) {
                span_momento = expan[valori]
                span_momento.style = 'color: #ffffff; background-color: #5315b6;';
                valori++;
            }
        }
                
        //--------------- Degradê ----------------------

        if(document.cookie.includes('degrade')){
            document.body.style = 'background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);';
            nave.style = 'background-color: transparent';
            testao.style = 'background-color: transparent';
            mais.style = 'background-color: transparent; border: 2px solid white;';
            var paras = document.querySelectorAll("p");
            var expan = document.querySelectorAll("span");
            var listas = document.querySelectorAll("ul");
            listas[0].style = 'background-color: transparent';
            listas[1].style = 'background-color: transparent';
            // expan[2].style.color = 'red';

            valori = 5
            while (valori < expan.length) {
                span_momento = expan[valori]
                span_momento.style = 'color: #ffffff; background-color: transparent;';
                valori++;
            }

            valora = 0
            while (valora < paras.length) {
                paras_momento = paras[valora];
                paras_momento.style = 'color: #ffffff; background-color: transparent; border: 1px solid white;';
                valora++;
            }
        }
                
        //--------------- Dark ----------------------

        if(document.cookie.includes('dark')){
            document.body.style = 'background-color: #201b2c';
            nave.style = 'background-color: #00ff88';
            mais.style = 'background-color: #00ff88';
            var expan = document.querySelectorAll("span");
            var listas = document.querySelectorAll("ul");
            var paras = document.querySelectorAll("p");
            listas[0].style = 'background-color: #00ff88';
            listas[1].style = 'background-color: #00ff88';
            // expan[2].style.color = 'red';

            valori = 5
            while (valori < expan.length) {
                span_momento = expan[valori]
                span_momento.style = 'color: #201b2c; background-color: #00ff88;';
                valori++;
            }

            valora = 0
            while (valora < paras.length) {
                paras_momento = paras[valora];
                paras_momento.style = 'color: #00ff88; background-color: transparent; border: 2px solid #514869;';
                valora++;
            }
        }

        //------------------- FONTES ------------------
        if(document.cookie.includes('systemui')){
            document.body.style = 'font-family: system-ui';
        }

        if(document.cookie.includes('arial')){
            document.body.style = 'font-family: Arial';
        }

        if(document.cookie.includes('verdana')){
            document.body.style = 'font-family: Verdana';
        }

        if(document.cookie.includes('consolas')){
            document.body.style = 'font-family: consolas';
        }

    </script>
</body>
</html>