const btn_nova = document.querySelector('.btn-nova');
const meio = document.querySelector('.caderno');

btn_nova.addEventListener('click',adicionarNovaNota)

function adicionarNovaNota(){
    meio.innerHTML = 
    '<iframe src="nova_nota.html" frameborder="0"></iframe>';
}
