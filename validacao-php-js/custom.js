"use strict"

// Pegar elementos
function pegarElemento(el){
    const elemento = document.getElementById(el);
    return elemento;
}

// Validando formato válido de email
function validaFormatoEmail(email){
    // Regex para validar formato válido de email user@dominio.com
    var re = /\S+@\S+\.\S+/;

    return re.test(email);
}

// Pegando o formulário de contato
const formularioDeContato = pegarElemento("cadMsgContato");

// Atribuindo validação dos inputs ao evento submit do formulário de contato
formularioDeContato.addEventListener('submit', validacaoDosInputs);

function validacaoDosInputs(e){
    // console.log(validaFormatoEmail(pegarElemento("email").value));

    // Verificando se o campos está vazio
    if(pegarElemento('nome').value === ""){
        // Prevenindo o recarregamento da página
        e.preventDefault();

        // Atribuindo mensagem de erro ao elemento que a mostrara
        pegarElemento("msgAlerta").innerHTML = "<p style='color: red;'>Erro: o campo Nome é obrigatório JS</p>";

        // Pausando o processamento
        return;
    }

    if (pegarElemento("email").value === "") {
        e.preventDefault();

        pegarElemento("msgAlerta").innerHTML = "<p style='color: red;'>Erro: o campo Email é obrigatório JS</p>";

        return;
    }

    if (!validaFormatoEmail(pegarElemento("email").value)) {
        e.preventDefault();

        pegarElemento("msgAlerta").innerHTML = "<p style='color: red;'>Erro: insira um email válido JS</p>";

        return;
    }

    if (pegarElemento("email").value === "") {
        e.preventDefault();

        pegarElemento("msgAlerta").innerHTML =
            "<p style='color: red;'>Erro: o campo Email é obrigatório JS</p>";

        return;
    }
}