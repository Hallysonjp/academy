$(document).ready(function(){
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.cel_with_ddd').mask('(00) 00000-0000');
    $('.phone_us').mask('(000) 000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
    $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/, optional: true
            }
        }
    });
    $('.ip_address').mask('099.099.099.099');
    $('.percent').mask('##0,00%', {reverse: true});
    $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.fallback').mask("00r00r0000", {
        translation: {
            'r': {
                pattern: /[\/]/,
                fallback: '/'
            },
            placeholder: "__/__/____"
        }
    });
    $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});

    $("#parcelas").on('change', function () {
        var parcela = $(this).children('option:selected').val();
        var valor   = $("#total-"+parcela).text();
        var amount  = $("#total-"+parcela).data('valor');

        $('#valor').val(valor);
        $('#amount').val(amount);
    })

});

function toastError(message){
    console.log(message);
    toastr.error(message);
}

$('#cpf').on('blur', function () {
    var cpf  = $(this).val();

    if(!validarCPF(cpf)){
        $(this).css('border-color', '#f00');
        swal("Ops! Encontramos um erro...", "O CPF informado não é válido! Por favor, corrija o CPF.", "warning");
    }else{
        $(this).css('border-color', '#e1e1e1');
    }
});

function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,'');
    if(cpf == '') return false;
    // Elimina CPFs invalidos conhecidos
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
        return false;
    // Valida 1o digito
    add = 0;
    for (i=0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    // Valida 2o digito
    add = 0;
    for (i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}

function alertMessage(message, type) {
    swal(message, type);
}

function openModal(url) {

    var email = $("#dados").data('email');
    var cpf   = $("#dados").data('cpf');

    swal.fire({
        title: "Lembrete",
        html: "<p><span style='color: #dd4444'>Caso este seja o seu primeiro acesso</span>, você deverá utilizar os seguintes dados para acessar o seu curso.</p>" +
              "<p>Email: Seu e-mail</p>" +
              "<p>Senha: Seu CPF (Somente números)</p>",
        type: "info",
        showCancelButton: true,
        cancelButtonText: "Sair.",
        confirmButtonColor: "#5c77fc",
        confirmButtonText: "Acessar!",
        closeOnConfirm: false
    }).then((result) => {
        if (result.value) {
            window.location.href = url;
        }
    });
}
