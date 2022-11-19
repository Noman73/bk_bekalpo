<script>
    function getMyAds(){
        console.log('mylist')
        $.get("{{URL::to(app()->getLocale().'/my_ads')}}")
        .then(res=>{
            $('#my-listing').html(res);
        })
    }
    $(document).on('click','#mylist',function(){
        getMyAds();
    })
    $(document).on('click','#myfavlist',function(){
        getMyFavAds();
    })
    function getMyFavAds(){
        console.log('myfavlist')
        $.get("{{URL::to(app()->getLocale().'/my_fav_ads')}}")
        .then(res=>{
            $('#my-listing').html(res);
        })
    }
    $(document).on('click','.deleteRow',function(){
        let posturl=$(this).data("url");
        console.log(posturl)
        $.get("{{route('users.myad_action')}}")
        .then(response=>{
            $('#modal').html(response);
            $('#post_url').val(posturl);
            $('#myad_action').modal('show')
        })
    })
    $(document).on('click','.promoteRow',function(){
        let posturl=$(this).data("url");
        console.log(posturl)
        $.get(posturl)
        .then(response=>{
            console.log(response)
            $('#modal').html(response);
            // $('#post_url').val(posturl);
            $('#promoteModal').modal('show')
        })
    })
    function unFav(post_id){
        console.log('myfavlist')
        $.get("{{URL::to(app()->getLocale().'/my_ads_unfav')}}/"+post_id)
        .then(res=>{
            getMyFavAds();
            alert(res.message);
        })
    }
    function profile()
    {
        $.get("{{URL::to(app()->getLocale().'/get-profile-form')}}")
        .then(res=>{
            console.log(res);
            $('#profile').html(res);
        }) 
    }
    $(document).on('change','#cities',function(){
        let division=$(this).val();
        if(division!=''){
            $.get("{{URL::to(app()->getLocale().'/get-location')}}/"+division)
            .then(response=>{
                console.log(response);
                let location="<option value=''>- Select an Option -</option>";
                response.forEach(function(d){
                    location+="<option value='"+d.id+"'>"+d.name+"</option>";
                })
                $('#areas').html(location);
            })
        }
    });
    $(document).on('click','.submit-btn',function(e){
        e.preventDefault()
        name=$('#name').val();
        gender=$("input[name='gender[]']:checked").val();
        phone=$('#phone').val();
        cities=$('#cities').val();
        areas=$('#areas').val();
        adress=$('#adress').val();
        file=document.getElementById('file').files;
        formData=new FormData()
        formData.append('name',name);
        formData.append('gender',gender);
        formData.append('phone',phone);
        formData.append('cities',cities);
        formData.append('areas',areas);
        formData.append('adress',adress);
        formData.append('name',name);
        if (file[0]!=null) {
            formData.append('image',file[0]);
        }
        request(formData);
    })
    function request(formData){
        axios.post("{{route('users.signup.update')}}",formData)
        .then((res)=>{
            if(res.data.message){
                Swal.fire(
                    'Good job!',
                    res.data.message,
                    'success'
                )
            }
            console.log(res);
        })
    }

    function readURL(input){
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            document.getElementById('imagex').setAttribute('src', e.target.result)
          };
          reader.readAsDataURL(input.files[0]);
      }
   }

   $(document).on('click','.pagination a',function(e){
        e.preventDefault()
        let link=$(this).attr('href')
        let page=link.split('page=')[1];
        $.get("{{URL::to(app()->getLocale().'/my_ads')}}?page="+page)
        .then(response=>{
            $('#my-listing').html(response);
            
        })
    })
    function featureRequest(id){
        package=$('#package').val();
        mobile=$('#mobile').val();
        transaction=$('#trnsid').val();
        payment_method=$('#payment_method').val();
        $.post(url+'/feature_request/'+id,{_token:"{{csrf_token()}}",package:package,mobile:mobile,transaction:transaction,payment_method:payment_method})
        .then((res)=>{
            console.log(res)
            if(res.message){
                Swal.fire(
                    'Thank You!',
                     res.message,
                    'success'
                )
                package=$('#package').val('');
                mobile=$('#mobile').val('');
                transaction=$('#trnsid').val('');
                $('#promoteModal').modal('hide');
            }
        })
    }
</script>