<script> 
var password = $('#inputPassword');
var confPassword = $('#inputConfirmPassword');
var submitBtn = $("#submitBtn");


submitBtn.on('click', function(event){
    if(password.val() != confPassword.val()){
        event.preventDefault();
        alert('Passwords dont match');
    }
});
password.change(function(){
    if(confPassword.val() == password.val()){
        password.addClass('passwordMatch');
        confPassword.addClass('passwordMatch');
    } 
    if(confPassword.val() != password.val()){
        password.addClass('passwordDontMatch');
        confPassword.addClass('passwordDontMatch');
    }
    if(password.val() == ""){
        password.removeClass('passwordMatch');
        password.removeClass('passwordDontMatch');
    }
});
confPassword.change(function(){
    if(confPassword.val() == password.val()){
        password.addClass('passwordMatch');
        confPassword.addClass('passwordMatch');
    } 
    if(confPassword.val() != password.val()){
        password.addClass('passwordDontMatch');
        confPassword.addClass('passwordDontMatch');
    }
    if(confPassword.val() == ""){
        confPassword.removeClass('passwordMatch');
        confPassword.removeClass('passwordDontMatch');
    }
});

</script>