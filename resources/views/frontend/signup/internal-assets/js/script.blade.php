<script>
    $(document).on('change','#cities',function(){
        let division=$(this).val();
        if(division!=''){
            $.get("{{URL::to(app()->getLocale().'/get-location')}}/"+division)
            .then(response=>{
                let location="<option value=''>- {{__('lang.pages.allads.select_an_option')}} -</option>";
                response.forEach(function(d){
                    location+="<option value='"+d.id+"'>"+d['name_'+lang]+"</option>";
                })
                $('#areas').html(location);
            })
        }
    });
</script>