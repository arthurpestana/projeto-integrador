const senha= document.querySelector("input[name=password]");
const confsenha = document.querySelector("input[name=conf-password]");
const senhaSTR = new String(senha.value)
const confsenhaSTR = new String(confsenha.value)
function senhas_(){

    

if (senha.value === confsenha.value ){
    
    if (senha.value.length < 6 || confsenha.value.length < 6){
        confsenha.setCustomValidity('Senhas precisam ter no minimo 6 caracteres')
} 
else{
        confsenha.setCustomValidity('')
    }

}
else{
    confsenha.setCustomValidity('Digite senhas iguais')
}

}
