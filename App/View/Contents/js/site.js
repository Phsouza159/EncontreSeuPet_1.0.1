/* 
 * 
 */

// manipulacao -- formularios 
    // validar em tempo real valor do telefone
    $('#formCadastroTelefone').change( function(){
         ValidarTelefone( $('#formCadastroTelefone').val()
                        , 'requerid-custom-telefone'
                        , '.input-telefone');
    });
    
// tela cadastro
$(function () {


    /*
     * Comtrole para a mensagem do required
     */
    $('.input-name , #formCadastroNome').click(function () {
        $('.input-name')
                .hide();
    });

    $('.input-sobrenome , #formCadastroSobrenome').click(function () {
        $('.input-sobrenome')
                .hide();
    });

    $('.input-cidade , #formCadastroCidade').click(function () {
        $('.input-cidade')
                .hide();
    });
    
    
    $('.input-telefone , #formCadastroTelefone').click(function () {
       $('.input-telefone')
               .hide();
    });
   
    $('.input-endereco , #formCadastroEndereco').click(function () {
       $('.input-endereco')
               .hide();
    });
   
    $('.input-dtNascimento , #formCadastroDtNascimento').click(function () {
       $('.input-dtNascimento')
               .hide();
    });
    
    
    

    $('.button_passo1').click(function () {

        $('.passo1')
                .show();
        $('.passo2, .passo3')
                .hide();


        $('.etapas1')
                .addClass('etapas-cards-active');
        $('.etapas2')
                .removeClass('etapas-cards-active , etapas-cards-active ,etapas-cards-sucesso');
        $('.etapas1')
                .removeClass('etapas-cards-sucesso');
        $('.etapas3')
                .removeClass('etapas-cards-sucesso');
    });

    $('.button_passo2').click(function () {

        // para a pessoa 
        if (validarFormulariosCadastro(1)) {

            $('.passo2')
                    .show();
            $('.passo1, .passo3').
                    hide();
            $('.etapas2')
                    .addClass('etapas-cards-active');
            $('.etapas1')
                    .addClass('etapas-cards-sucesso');

            $('.etapas1')
                    .removeClass('etapas-cards-active');
            $('.etapas3')
                    .removeClass('etapas-cards-active , etapas-cards-sucesso');
            $('.etapas2')
                    .removeClass('etapas-cards-sucesso');
        }
    });

    $('.button_passo3').click(function () {
        $('.passo3')
                .show();
        $('.passo1, .passo2')
                .hide();

        $('.etapas3')
                .addClass('etapas-cards-active');
        $('.etapas1')
                .addClass('etapas-cards-sucesso');
        $('.etapas2')
                .addClass('etapas-cards-sucesso');


        $('.etapas1')
                .removeClass('etapas-cards-active');
        $('.etapas2')
                .removeClass('etapas-cards-active');
    });


});

function validarFormulariosCadastro(oper = 0) {
    switch (oper)
    {
        case 0:
            return;
            break;

        case 1 :
            return validarEtapa_pessoa();
            break;

        case 2:
            break;
}
}


function validarEtapa_pessoa() {

    var controle = false;
    /**
     * Nao foi possivel criar condicao para verificar se os formularios estao vazio com switch (bug no break)
     */
    //existe valor no input-nome?
    if ($('#formCadastroNome').val() === "")
    {
        //alert("o campo nome está vazio");
        $('.input-name')
                .show();
        $('.input-name')
                .addClass('requerid-custom');

        controle = true;
    }
    //existe valor no input-sobrenome?
    if ($('#formCadastroSobrenome').val() === "")
    {
        //alert("o campo sobrenome está vazio");
        $('.input-sobrenome')
                .show();
        $('.input-sobrenome')
                .addClass('requerid-custom');

        controle = true;
    }
    //existe valor no input-cidade?
    if ($('#formCadastroCidade').val() === "")
    {
        //alert("o campo cidade está vazio");
        $('.input-cidade')
                .show();
        $('.input-cidade')
                .addClass('requerid-custom');

        controle = true;
    }
    //existe valor no input-telefone?
    if($('#formCadastroTelefone').val() === "")
    {
        //alert("O campo telefone está vazio");
        $('.input-telefone')
                .show();
        $('.input-telefone')
                .addClass('requerid-custom');
        
        controle = true;
    }
    ValidarTelefone( $('#formCadastroTelefone').val()
                                    , 'requerid-custom-telefone'
                                    , '.input-telefone');
    //existe valor no input-endereco?
    if($('#formCadastroEndereco').val() === "")
    {
        //alert("O campo endereço está vazio");
        $('.input-endereco')
                .show();
        $('.input-endereco')
                .addClass('requerid-custom');
        controle = true;
    }
    //existe valor no input-dataDeNascimento?
    if($('#formCadastroDtNascimento').val() === "")
    {
        //alert("O campo endereco está vazio");
        
        $('.input-dtNascimento')
                .show();
        
        $('.input-dtNascimento')
                .addClass('requerid-custom-data');
    }
    
    if (controle)
    {
        alert("Existem campos vazios!");
        return false;
    }
    return true; // se nao existir formularios vazios - validacao true
    
}

function ValidarTelefone(num = null , nameClass = null , inputName = null)
{

    
    if(num === null || nameClass === null || inputName === null)
    {
        return false;
    }
    if(num.length < 8 || num.length > 9)
    {
            console.log(num);
        $(inputName)
                .show();
        $(inputName)
                .addClass(nameClass);
        
        $(nameClass).before('Número de telefone inválido');
        return false;
    }
    
    return true; 
}