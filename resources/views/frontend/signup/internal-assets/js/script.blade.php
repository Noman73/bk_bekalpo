<script>
    $(document).on('change','#cities',function(){
        let division=$(this).val();
        if(division!=''){
            $.get("{{URL::to('/get-location')}}/"+division)
            .then(response=>{
                let location="<option value=''>- Select an Option -</option>";
                response.forEach(function(d){
                    location+="<option value='"+d.id+"'>"+d.name+"</option>";
                })
                $('#areas').html(location);
            })
        }
    });
</script>