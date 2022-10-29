const btn_nova = document.querySelector('.btn-nova');
const meio = document.querySelector('.caderno');
const btn_identifica = document.querySelector('.envia');
const input_senha = document.querySelector("#identificar");
const corpo = document.querySelector('.corpo');
const container = document.querySelector('.identificar-container');
const input_pesquisa = document.querySelector('.pesquisa');
const nav = document.querySelector('.header');
const header = document.querySelector('.nav');
const btn_config = document.querySelector('.config');
const cadeado = document.querySelector('.icon-lock');

//  -------------------  IDENTIFICAR  ---------------------

var valor = 0;
var contia = 0;
input_pesquisa.disabled = true;
nav.style.opacity = '60%';
btn_nova.style.display = 'none';
btn_config.style.display = 'none';
input_senha.type = 'password';

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

    if(valor <= 3){
    meio.innerHTML += '<iframe src="nova_nota.html" frameborder="0"></iframe>';
    }
    else{
        alert('Quantidade máxima de rascunhos atingida');
    }

}
