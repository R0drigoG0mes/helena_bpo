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
const output_entrou = document.querySelector('.entrou1');
const area_texto = document.querySelector('.caixa-texto');

//  -------------------  IDENTIFICAR  ---------------------

var valor = 0;
var contia = 0;
input_senha.type = 'password';
const senha = 'lialinda';

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