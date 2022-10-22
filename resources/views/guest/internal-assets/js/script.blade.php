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
            params=$('#keyword').val();
            window.location=url+"/ads?"+'keyword='+params;
}); 
</script>