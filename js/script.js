const btn_nova = document.querySelector('.btn-nova');
const meio = document.querySelector('.caderno');
const btn_identifica = document.querySelector('.envia');
const input_senha = document.querySelector("#identificar");
const container = document.querySelector('.identificar-container');
const input_pesquisa = document.querySelector('.pesquisa');
const nav = document.querySelector('.header');
const header = document.querySelector('.nav');
const btn_config = document.querySelector('.config');
const cadeado = document.querySelector('.icon-lock');
const xis1 = document.querySelector('.xis1');
const xis2 = document.querySelector('.xis2');
const xis3 = document.querySelector('.xis3');

//  -------------------  IDENTIFICAR  ---------------------

var valor = 0;
var contia = 0;
input_pesquisa.disabled = true;
nav.style.opacity = '60%';
btn_nova.style.display = 'none';
btn_config.style.display = 'none';
input_senha.type = 'password';
xis1.style.display = 'none';
xis2.style.display = 'none';
xis3.style.display = 'none';

const senha = 'lialinda';

btn_identifica.addEventListener('click',analisar)
cadeado.addEventListener('click',mostrar)

function analisar(){
    if(input_senha.value == senha){
        input_pesquisa.disabled = false;
        nav.style.opacity = '100%';
        btn_nova.style.display = 'flex';
        btn_config.style.display = 'inline';
        container.style.display = 'none'
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

// ----------------------- NOVA NOTA ---------------------------

btn_nova.addEventListener('click',adicionarNovaNota)

function adicionarNovaNota(){
    valor++;

    if(valor == 1){
    meio.innerHTML += '<iframe src="nova_nota.html" frameborder="0" id="iframe-1"></iframe>';
    xis1.style.display = 'inline';
    }

    else if(valor == 2){
        meio.innerHTML += '<iframe src="nova_nota.html" frameborder="0" id="iframe-2"></iframe>';
        xis1.style.display = 'inline';
        xis2.style.display = 'inline';
        xis2.style.left = '825px'
        }

    else if(valor == 3){
         meio.innerHTML += '<iframe src="nova_nota.html" frameborder="0" id="iframe-3"></iframe>';
         xis1.style.display = 'inline';
         xis2.style.display = 'inline';
         xis3.style.display = 'inline';
         xis3.style.left = '1273px'
        }

    else{
        alert('Quantidade máxima de rascunhos atingida');
        valor = 3;
    }

}

// -------------------- REMOVER RASCUNHO ----------------

xis1.addEventListener('click',remover1);
xis2.addEventListener('click',remover2);
xis3.addEventListener('click',remover3);

function remover1(){
    const iframe1 = document.getElementById("iframe-1");
    iframe1.remove();
    xis1.style.display = 'none';
    valor--;
    if(xis2.style.display == 'inline' && xis3.style.display == 'inline')
    {xis2.style.left = '373px';
    xis3.style.left = '825px';}
    else{
        xis3.style.left = '373px';
        xis2.style.left = '373px';
    }
}

function remover2(){
    const iframe2 = document.getElementById("iframe-2");
    iframe2.remove();
    xis2.style.display = 'none';
    valor--;
    if(xis3.style.display == 'inline' && xis1.style.display == 'inline')
    {xis3.style.left = '825px';}
    else
    {xis3.style.left = '373px';}
}

function remover3(){
    const iframe3 = document.getElementById("iframe-3");
    iframe3.remove();
    xis3.style.display = 'none';
    valor--;
}