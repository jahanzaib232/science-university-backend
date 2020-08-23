<script> 
var password = $('#inputPassword');
var confPassword = $('#inputConfirmPassword');


confPassword.keyup(function(){
    if(confPassword.val() == password.val()){
        password.addClass('passwordMatch');
        confPassword.addClass('passwordMatch');
    } else {
        password.addClass('passwordDontMatch');
        confPassword.addClass('passwordDontMatch');
    }
    if(confPassword.val() == ""){
        confPassword.removeClass('passwordMatch');
        confPassword.removeClass('passwordDontMatch');
    }
});
password.keyup(function(){
    if(confPassword.val() == password.val()){
        password.addClass('passwordMatch');
        confPassword.addClass('passwordMatch');
    } else {
        password.addClass('passwordDontMatch');
        confPassword.addClass('passwordDontMatch');
    }
    if(password.val() == ""){
        password.removeClass('passwordMatch');
        password.removeClass('passwordDontMatch');
    }
});
</script>