$(document).ready(function(){

//For Card Number formatted input
    var cardNum = document.getElementById('cr_no');
    cardNum.onkeyup = function (e) {
        if (this.value == this.lastValue) return;
        var caretPosition = this.selectionStart;
        var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
        var parts = [];

        for (var i = 0, len = sanitizedValue.length; i < len; i +=4) { parts.push(sanitizedValue.substring(i, i + 4)); } for (var i=caretPosition - 1; i>= 0; i--) {
            var c = this.value[i];
            if (c < '0' || c> '9') {
                caretPosition--;
            }
        }
        caretPosition += Math.floor(caretPosition / 4);

        this.value = this.lastValue = parts.join(' ');
        this.selectionStart = this.selectionEnd = caretPosition;
    }

    //For Date formatted input
    var expDate = document.getElementById('exp');
    expDate.onkeyup = function (e) {
        if (this.value == this.lastValue) return;
        var caretPosition = this.selectionStart;
        var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
        var parts = [];

        for (var i = 0, len = sanitizedValue.length; i < len; i +=2) { parts.push(sanitizedValue.substring(i, i + 2)); } for (var i=caretPosition - 1; i>= 0; i--) {
            var c = this.value[i];
            if (c < '0' || c> '9') {
                caretPosition--;
            }
        }
        caretPosition += Math.floor(caretPosition / 2);

        this.value = this.lastValue = parts.join('/');
        this.selectionStart = this.selectionEnd = caretPosition;
    }

});

$("#cr_no").on('focusout', function () {
    var number = $(this).val();
    var brand  = getCardFlag(number);
    var card;

    switch (brand) {
        case 'mastercard':
            card = "https://seeklogo.com/images/M/Master_Card-logo-027CB51F96-seeklogo.com.png";
            break;
        case 'visa' :
            card = "https://seeklogo.com/images/V/VISA-logo-16F4F82D13-seeklogo.com.png";
            break;
        case 'amex' :
            card = "https://seeklogo.com/images/A/american-express-logo-849A4E1124-seeklogo.com.png";
            break;
        case 'elo' :
            card = "https://seeklogo.com/images/E/elo-logo-0B17407ECC-seeklogo.com.png";
            break;
        case 'hipercard' :
            card = "https://seeklogo.com/images/H/Hipercard-logo-AF076596BD-seeklogo.com.png";
            break;
        default:
            card = "https://res.cloudinary.com/value-penguin/image/upload/c_limit,dpr_1.0,f_auto,h_1600,q_auto,w_1600/v1/unavailable-card-update_c5bzxf.png";
    }
    $("#brand-logo-card").html('<img style="margin-left: 15px ;height: 20px" src="'+card+'">')
});

function getCardFlag(cardnumber) {
    var cardnumber = cardnumber.replace(/[^0-9]+/g, '');

    var cards = {
        visa      : /^4[0-9]{12}(?:[0-9]{3})/,
        mastercard : /^5[1-5][0-9]{14}/,
        diners    : /^3(?:0[0-5]|[68][0-9])[0-9]{11}/,
        amex      : /^3[47][0-9]{13}/,
        discover  : /^6(?:011|5[0-9]{2})[0-9]{12}/,
        hipercard  : /^(606282\d{10}(\d{3})?)|(3841\d{15})/,
        elo        : /^((((636368)|(438935)|(504175)|(451416)|(636297))\d{0,10})|((5067)|(4576)|(4011))\d{0,12})/,
        jcb        : /^(?:2131|1800|35\d{3})\d{11}/,
        aura      : /^(5078\d{2})(\d{2})(\d{11})$/
    };

    for (var flag in cards) {
        if(cards[flag].test(cardnumber)) {
            return flag;
        }
    }

    return false;
}