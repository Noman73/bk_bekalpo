
<script>

width=$(window).width();
console.log(width);

function modalResponsive(){
    console.log('fired')
    if(width<768){
        console.log(width)
        $('#left-part').addClass('d-none')
        $('#back-button').removeClass('d-none')
        $('#right-part').removeClass('d-none')
    }
}
function backModal()
{
    $('#left-part').removeClass('d-none')
    $('#right-part').addClass('d-none')
}

</script>

