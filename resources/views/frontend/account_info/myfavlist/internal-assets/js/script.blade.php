<script>
    $(document).on('click','.edit',function(){
        console.log('edit')
        window.location=$(this).data('url');
    })
</script>