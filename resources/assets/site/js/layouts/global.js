if (localStorage.theme === 'dark') {
    $('#app').addClass('dark');
} else {
    $('#app').removeClass('dark');
}
if ($('#dark').length){
    var switch_btn = $('#dark');
    switch_btn.click((e)=>{
        if (localStorage.theme === 'dark') {
            $('#app').removeClass('dark');
            localStorage.theme = 'light';
        } else {
            $('#app').addClass('dark');
            localStorage.theme = 'dark';
        }
    });
}

$(window).on('load', function(){
    $( "#loading-holder" ).fadeOut(500, function() {
        $( "#loading-holder" ).remove();
    });
});


// alert
if ($('#fail-payment').length){
    toastr.error('پرداخت ناموفق! در صورت کسر از حساب تا حداکثر 48 ساعت برمیگردد');
}
if ($('#success-payment').length){
    toastr.success('پرداخت شما با موفقیت انجام شد');
}
if ($('#success-plan').length){
    toastr.success('پلن برنامه با موفقیت ارتقا یافت');
}
if ($('#success-server').length){
    toastr.success('سرور برنامه با موفقیت تمدید یا ارتقا یافت');
}
if ($('#success-support').length){
    toastr.success('پشتیبانی برنامه با موفقیت تمدید شد');
}
if ($('#success-alert').length){
    toastr.success('عملیات با موفقیت انجام شد');
}
if ($('#success-renew').length){
    toastr.success('راه اندازی برنامه با موفقیت آغاز شد');
}


window.toggleOverflow = function(infoModal) {
    if(infoModal) {
        document.body.dataset.top = `${window.scrollY}px`;
        document.body.style.overflow = 'hidden';
    } else {
        const scrollY = document.body.dataset.top;
        document.body.style.overflow = 'visible';
        document.body.dataset.top = '';
        window.scrollTo(0, parseInt(scrollY || '0'));
    }
}


$(document).ready(function () {
    $('#uploadAvatar').change(function () {
        $(this).closest('form').submit();
    });

    
    $('.copy-btn').click(function (e){
       var id = $(this).data('id');
       $('#' + id).select();
       document.execCommand("copy");
        toastr.success('کپی انجام شد');
    });
    $('.copy-btn-text').click(function (e){
        var id = $(this).data('id');
        var copyText = document.createElement("textarea");
        document.body.appendChild(copyText);
        var text =  $('#' + id).text();
        copyText.value = text;
        copyText.select();
        document.execCommand("copy");
        document.body.removeChild(copyText);
        toastr.success('کپی انجام شد');
    });


    $('.timer-item').each( function(){
        timer($(this));
    });
});
function timer($this) {
    var timestamp = $this.find('.timestamp').data('timestamp');
    setInterval(function() {
        var now = new Date().getTime();
        var distance = timestamp - now;

        var d = Math.floor(distance / (1000 * 60 * 60 * 24));
        var h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var s = Math.floor((distance % (1000 * 60)) / 1000);

        $this.find('.days').text(d);
        $this.find('.hours').text(h);
        $this.find('.minutes').text(m);
        $this.find('.seconds').text(s);

    }, 1000);
}


function validatePassword(password) {

    var bar = $('#strong-bar');
    var msg = $('#strong-msg');
    var help = $('#password-help');

    if (password.length === 0) {
        bar.css({'width': '0'});
        help.css({'max-height': 0 + 'px', 'padding': 0 + 'px'});
        msg.text('');
        return;
    }

    var matchedCase = new Array();
    matchedCase.push("[$@$!%*#?&]"); // Special Charector
    matchedCase.push("[A-Z]");      // Uppercase Alpabates
    matchedCase.push("[0-9]");      // Numbers
    matchedCase.push("[a-z]");     // Lowercase Alphabates
    matchedCase.push(".{8,}");     // 8

    var ctr = 0;
    for (var i = 0; i < matchedCase.length; i++) {
        if (new RegExp(matchedCase[i]).test(password)) {
            ctr++;
        }
    }

    var color = "";
    var strength = "";
    var width = 0;
    switch (ctr) {
        case 0:
        case 1:
            strength = "خیلی ضعیف";
            color = "red";
            width = 10;
            help.css({'max-height': 110 + 'px' , 'padding': 5 + 'px'});
            break;
        case 2:
            strength = "ضعیف";
            color = "red";
            width = 20;
            help.css({'max-height': 110 + 'px' , 'padding': 5 + 'px'});
            break;
        case 3:
            strength = "متوسط";
            color = "orange";
            width = 50;
            help.css({'max-height': 110 + 'px' , 'padding': 5 + 'px'});
            break;
        case 4:
            strength = "قوی";
            color = "green";
            width = 80;
            help.css({'max-height': 110 + 'px' , 'padding': 5 + 'px'});
            break;
        case 5:
            strength = "خیلی قوی";
            color = "green";
            width = 100;
            help.css({'max-height': 0 + 'px', 'padding': 0 + 'px'});
            break;
            
    }

    msg.text(strength);
    bar.css({'width': width + '%', 'background': color, 'height': '3px'});
    msg.css({'color': color, 'margin-top': '4px'});
}
$(document).on('keyup', '#register-password', function (e) {
    validatePassword($(this).val());
});

