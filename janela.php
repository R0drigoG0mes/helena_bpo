<?php
if(isset($_POST['alterar'])){
    $alterar = $_POST['alterar'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="icones/style.css">
    <link rel="stylesheet" href="icones/cadeado/style.css">
    <title>Alterar Nota</title>

    <style>
        iframe{
            width: 650px;
            height: 400px;
            background-color: white;
            border: 2px solid #005e99;
            padding: 10px;
            border-radius: 10px;
            overflow-y: auto;
            margin-bottom: 0px;
        }

        iframe:focus{
            outline: none;
        }

        body{
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            box-sizing: border-box;
        }

        ul{
            display: inline-block;
            padding: 5px;
            margin: 5px 0px 0px 0px;
            list-style-type: none;
            color: white;
            border-radius: 50px;
            background-color: #005e99;
        }

        ul li{
            float: left;
            font-size: 1.2em;
            margin: 0px 10px 0px 10px;
            cursor: pointer;
            text-shadow: 1px 1px 1px black;
        }

        .salvar{
            position: absolute;
            right: 18px;
            bottom: 16px;
            color: green;
            font-size: 1.4em;
            cursor: pointer;
            text-shadow: 1px 1px 1px black;
        }

        .salvar:hover{
            color: rgb(0, 177, 0);
        }

        abbr{text-decoration: none;}
    </style>

</head>
<body>
    <p><?php echo $alterar; ?></p>
    <iframe src="about:blank" id="_iframe" name="iframe" contenteditable="true"></iframe>
    
    <ul>
        <li><abbr title="Negrito"><span class="icon-bold" onclick="bold()"></span></abbr></li>
        <li><abbr title="Itálico"><span class="icon-italic" onclick="italico()"></span></abbr></li>
        <li><abbr title="Tachado"><span class="icon-strikethrough" onclick="tachado()"></span></abbr></li>
        <li><abbr title="Sublinhado"><span class="icon-underline" onclick="sublinhado()"></span></abbr></li>
        <li><abbr title="Alinhar à Esquerda"><span class="icon-paragraph-left" onclick="alinhar_esquerda()"></span></abbr></li>
        <li><abbr title="Justificar"><span class="icon-paragraph-justify" onclick="justificar()"></span></abbr></li>
        <li><abbr title="Alinhar no Centro"><span class="icon-paragraph-center" onclick="alinhar_centro()"></span></abbr></li>
        <li><abbr title="Alinhar à Direita"><span class="icon-paragraph-right" onclick="alinhar_direita()"></span></abbr></li>
    </ul>

    <abbr title="Salvar (Shift Right)"><span id="alterar" class="icon-checkmark salvar"></span></abbr>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script>
        const iframe_id = document.getElementById("_iframe");
        iframe.document.designMode = 'on';
        const tela = iframe_id.contentWindow;
        tela.document.body.style = 'overflow-wrap: break-word';
        tela.document.body.style = "font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif";

        //------------------- EXEC COMMANDS -------------------

        var bold = function(){
                iframe.document.execCommand('bold', false, null);
            }

            var italico = function(){
                iframe.document.execCommand('italic', false, null);
            }

            var sublinhado = function(){
                iframe.document.execCommand('underline', false, null);
            }

            var tachado = function(){
                iframe.document.execCommand('strikeThrough', false, null);
            }

            var alinhar_direita = function(){
                iframe.document.execCommand('justifyRight', false, null);
            }

            var alinhar_esquerda = function(){
                iframe.document.execCommand('justifyLeft', false, null);
            }

            var justificar = function(){
                iframe.document.execCommand('justifyFull', false, null);
            }

            var alinhar_centro = function(){
                iframe.document.execCommand('justifyCenter', false, null);
            }

            //--------------------- RECEBER MENSAGENS -----------------



    </script>

</body>
</html>