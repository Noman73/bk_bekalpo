<script>

$('#keyword').keypress(function(event){
    // event.preventDefault();
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        event.preventDefault();
            params=$(this).val();
            window.location=url+"/ads?"+'keyword='+params;
        }
}); 
$('.submit-btn').click(function(event){
        event.preventDefault();
            x=this.classList.contains('login-btn');
            if(x){
                window.location=$(this).attr('href');
                return false;
            }
            params=$('#keyword').val();
            window.location=url+"/ads?"+'keyword='+params;
}); 
</script>