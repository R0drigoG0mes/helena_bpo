const btn_nova = document.querySelector('.btn-nova');
const meio = document.querySelector('.caderno');
const btn_identifica = document.querySelector('.envia');
const input_senha = document.querySelector("#identificar");
const container = document.querySelector('.identificar-container');
const input_pesquisa = document.querySelector('.pesquisa');
const nav = document.querySelector('.header');
const header = document.querySelector('.nav');
const btn_config = document.getElementById("opcao");
const cadeado = document.querySelector('.icon-lock');
const output_entrou = document.querySelector('.entrou1');
const area_texto = document.querySelector('.caixa-texto');
const lista_opcoes = document.querySelector('.atributos');
const lista_opcoes2 = document.querySelector('.atributos_2');

//---------- Temas -------------

const azul = document.getElementById("azul");
const roxo = document.getElementById("roxo");
const degrade = document.getElementById("degrade");
const dark = document.getElementById("dark");

// -------------- Fonte ----------------------

const systemui = document.getElementById("systemui");
const arial = document.getElementById("arial");
const verdana = document.getElementById("verdana");
const consolas = document.getElementById("consolas");

//  -------------------  IDENTIFICAR  ---------------------

var selecionar = 0;
var valor = 0;
var contia = 0;
input_senha.type = 'password';
const senha = 'lialinda';
lista_opcoes.style.display = 'none';
lista_opcoes2.style.display = 'none';

function logado(){
    if(document.cookie.includes('entrou')){
    container.style.display = 'none';
    input_pesquisa.disabled = false;
    nav.style.opacity = '100%';
    btn_nova.style.display = 'flex';
    btn_config.style.display = 'inline';
    }
    else{
        container.style.display = 'block';
        input_pesquisa.disabled = true;
        nav.style.opacity = '60%';
        btn_nova.style.display = 'none';
        btn_config.style.display = 'none';

        btn_identifica.addEventListener('click',analisar)
        cadeado.addEventListener('click',mostrar)

        window.addEventListener("keydown", function(e){
            if(e.code == 'Enter' && container.style.display == 'block'){
                analisar();
            }
        })

        function analisar(){
            if(input_senha.value == senha){
                input_pesquisa.disabled = false;
                nav.style.opacity = '100%';
                btn_nova.style.display = 'flex';
                btn_config.style.display = 'inline';
                container.style.display = 'none';
                document.cookie = 'entrou' + '=' + 'sim';       
            }
            else{
                alert('Senha incorreta');
                input_senha.value = '';
                cadeado.classList.add('icon-lock');
                cadeado.classList.remove('icon-unlocked');
                input_senha.type = 'password';
            }
        }

        function mostrar(){
            contia++;
            if(contia == 1)
            {
                input_senha.type = 'text';
                cadeado.classList.remove('icon-lock');
                cadeado.classList.add('icon-unlocked');
            }

            if(contia == 2){
                input_senha.type = 'password';
                cadeado.classList.add('icon-lock');
                cadeado.classList.remove('icon-unlocked');
                contia = 0;
            }
        }

    }
}

logado();

//-------------------------------------------NOVA NOTA--------------------

btn_nova.addEventListener('click', nova_nota);
window.addEventListener("keydown", function(e){
    if(e.code == 'Home'){
        nova_nota();
    }
})

function nova_nota(){
    const janela_nova_nota = window.open('nova_nota.html', '_blank','width=700px, height=500px');
}

//-------------- PESQUISA ------------------

input_pesquisa.addEventListener("input", function(e){
    var filhos_body = document.body.getElementsByTagName('*');
    
    var footer_ = filhos_body[33];

    var paragrafos = footer_.getElementsByTagName('*');

    for(var indice = 0; paragrafos[indice] == '[object HTMLParagraphElement]'; indice += 7){

        if(paragrafos[indice].textContent.includes(input_pesquisa.value) == false){
            paragrafos[indice].style.display = 'none';
        }
        else if(paragrafos[indice].textContent.includes(input_pesquisa.value) == true){
            paragrafos[indice].style.display = 'inline-block';
        }

    }

});

//------------ CONFIGURAÇÕES --------------------

btn_config.addEventListener('click', configurar);

function configurar(){
    selecionar++;
    if(selecionar == 1){
    lista_opcoes.style.display = 'inline-block';
    lista_opcoes2.style.display = 'inline-block';
    }
    
    else if(selecionar == 2){
    lista_opcoes.style.display = 'none';
    lista_opcoes2.style.display = 'none';
    selecionar = 0;
    }
}

//----------------- COKIES ---------------
azul.addEventListener('click', azulado);

function azulado(){
    document.cookie = 'Tema' + '=' + '';
    location.reload();
}

roxo.addEventListener('click', roxear);

function roxear(){
    document.cookie = 'Tema' + '=' + 'roxo';
    location.reload();
}

degrade.addEventListener('click', degradado);

function degradado(){
    document.cookie = 'Tema' + '=' + 'degrade';
    location.reload();
}

dark.addEventListener('click', darkado);

function darkado(){
    document.cookie = 'Tema' + '=' + 'dark';
    location.reload();
}

//----------- Fonte ----------------

systemui.addEventListener('click', systemu);

function systemu(){
    document.cookie = 'Fonte' + '=' + 'systemui';
    location.reload();
}

arial.addEventListener('click', aria);

function aria(){
    document.cookie = 'Fonte' + '=' + 'arial';
    location.reload();
}

verdana.addEventListener('click', verdan);

function verdan(){
    document.cookie = 'Fonte' + '=' + 'verdana';
    location.reload();
}

consolas.addEventListener('click', consola);

function consola(){
    document.cookie = 'Fonte' + '=' + 'consolas';
    location.reload();
}

