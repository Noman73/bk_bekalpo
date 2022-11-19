<script>
    $(document).on('change','#category',function(){
        let category_id=$(this).val();
        if(category_id==''){
            $('#sub_category').html("<option value=''>--SELECT--</option>");
            $('#init_sub_category').addClass('d-none')
            $('.post-information').addClass('d-none')
        }
        $.get("{{URL::to(app()->getLocale().'/get-subcategory')}}/"+category_id)
        .then(response=>{
            if(response.length>0){

                $('#init_sub_category').removeClass('d-none')
            }
            html="<option value=''>--{{__('lang.pages.allads.select_an_option')}}--</option>"
            response.forEach(function(d){
            html+="<option value='"+d.id+"'>"+d['name_'+lang]+"</option>"
            })
            $('#sub_category').html(html);
        })
    })

    $(document).on('change','#sub_category',function(){
        let subCatId=$(this).val();
        if(subCatId!=''){
            $.get("{{URL::to(app()->getLocale().'/field-permission')}}/"+subCatId)
            .then(response=>{
                let arr=[];
                response.forEach(function(d){
                        arr.push(d.field_name);
                })
                getBrand(arr);
                $('.post-information').removeClass('d-none')
               
            })
        }
    });

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
    $(document).on('change','#brand',function(){
        let brand=$(this).val();
        if(brand!=''){
            $.get("{{URL::to(app()->getLocale().'/get-model')}}/"+brand)
            .then(response=>{
                let model="<option value=''>- {{__('lang.pages.allads.select_an_option')}} -</option>";
                response.forEach(function(d){
                    model+="<option value='"+d.id+"'>"+d.name+"</option>";
                })
                $('#model').html(model);
            })
        }
    });
    function formRequest(){
    // let images=document.getElementsByName('images[]')[0].files;
    let images=imagesFiles;
    let title=$('#title').val();
    let ad_type=$('#ad_type').val();
    let category=$('#category').val();
    let sub_category=$('#sub_category').val();
    let price_type=$('#price_type').val();
    let price=$('#price').val();
    let condition= $("input[name='condition[]']:checked").val();
    let brand=$('#brand').val();
    let model=$('#model').val();
    if (model==null && $('#model').length>0) {
        model='';
    }
    let feature=$("input[name='feature[]']:checked")
                .map(function(){return $(this).val();}).get();
    if(feature.length==0 && $('#init_feature').length==0){
        feature=undefined;
    }
    let authenticity=$("input[name='authenticity[]']:checked").val();
    let item_type=$('#item_type').val();
    let cities=$('#cities').val();
    let areas=$('#areas').val();
    let phones=$("input[name='phones[]']:checked").val();
    // new field
    let size=$('#size').val();
    let unit_type=$('#unit_type').val();
    let trim=$('#trim').val();
    let manufacture_year=$('#manufacture_year').val();
    let run_kilo=$('#run_kilometre').val();
    let capacity=$('#capacity').val();
    let fueltype=$("input[name='fueltype[]']:checked")
                .map(function(){return $(this).val();}).get();
    if(fueltype.length==0 && $('#init_fueltype').length==0){
        fueltype=undefined;
    }
    let transmission=$("input[name='transmission[]']:checked").val();
    if($('#init_transmission').length!=0 && transmission==undefined){
        transmission='';
    }
    let bodytype=$('#body_type').val();
    let registration_year=$('#registration_year').val();
    // end new field
    let description=$('#description').val();
    let id=$('#id').val();
    let otp=$('#otp').val();
    var formArr={title:title,otp:otp,ad_type:ad_type,category:category,sub_category:sub_category,price_type:price_type,price:price,condition:condition,brand:brand,model:model,feature:feature,authenticity:authenticity,feature:feature,item_type:item_type,cities:cities,areas:areas,phones:phones,size:size,unit_type:unit_type,trim:trim,manufacture_year:manufacture_year,run_kilometre:run_kilo,capacity:capacity,fuel_type:fueltype,transmission:transmission,body_type:bodytype,registration_year:registration_year,description:description,images:images}

    var formData= new FormData();
    Object.keys(formArr).forEach((val,index,array)=>{
        compressed=false;
        if (formArr[val]!==undefined) {
            if(val=='images'){
                for (let i = 0; i < formArr[val].length; i++) {
                    new Compressor(formArr[val][i],{
                        maxWidth:817.5,
                        maxHeight:500,
                        quality: 0.3,
                        success(result) {
                        formData.append('images[]',result, result.name);
                        if(formArr[val].length===(i+1)){
                            compressed=true;
                        }
                    },
                    error(err) {
                        console.log(err.message);
                    },
                    });
                }
            }else{
                formData.append(val,formArr[val]);
            }
        }

       var checkCompression=setInterval(function() {
            if(compressed===true && index+1===array.length){
                clearInterval(checkCompression)
                fetch();
            }
        },1500)
    })
    function fetch(){
        axios.post("{{URL::to(app()->getLocale().'/post')}}",formData)
        .then(response=>{
            if(response.data.message){

                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                )
                setTimeout(() => {
                   window.location="{{URL::to(app()->getLocale().'/account')}}"
                }, 500);
            }else if(response.data.error){
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
              var keys=Object.keys(response.data.error);
              keys.forEach(function(d){
                
                $('#'+d).addClass('is-invalid');
                $('#'+d+'_msg').text(response.data.error[d][0]);
                if(d=='fuel_type'){
                    $('#fuel_type_msg').show()
                }
                if(d=='phones'){
                    $('#phones_msg').show()
                    $("#phones_msg").parent().removeClass('is-invalid')
                }
                if(d=='transmission'){
                    $('#transmission_msg').show();
                }
              })
            }
        })
    }   
}

$(document).on('click','#otp_btn',function(){
    let mobile=$('#phone').val();
    $.post("{{URL::to(app()->getLocale().'/set-otp')}}",{_token:'{{csrf_token()}}',mobile:mobile,_method:'POST'})
    .then(response=>{
        msg=response.split(':')[0];
        if(msg=='SMS SUBMITTED'){
            Swal.fire(
                    'Thank You!',
                    'We Will Send You a Message With Verification Code In 2 minutes',
                    'success'
                )
            $('#otp_input').removeClass('d-none');
            $('#otp_btn').attr('disabled',true);
            $('#otp_btn').text('Resend')
            countdown('countdown', 0, 0, 2, 0);
        }
    })
})

$(document).on('click','#add-phone',function(){
    phone=$('#phone').val();
    otp=$('#otp').val();
    $.post("{{URL::to(app()->getLocale().'/add_phone')}}",{_method:'POST',_token:"{{csrf_token()}}",phone:phone,otp:otp})
    .then((response)=>{
        if(response.message){
        $('#phone').val('');
        $('#otp').val('');
        $('#new-phone-btn').removeClass('d-none');
        $('#init_add_phone').addClass('d-none');
        $('#otp_input').addClass('d-none');
        getPhoneNumbers();
        }else{
            $('input').removeClass('is-invalid');
            $('select').removeClass('is-invalid');
            var keys=Object.keys(response.error);
            keys.forEach(function(d){
                $('#'+d).addClass('is-invalid');
                $('#'+d+'_msg').text(response.error[d][0]);
            })
        }
    })
})

$(document).on('click','#new-phone-btn',function(){
    $('#init_add_phone').removeClass('d-none');
    $(this).addClass('d-none');
})
function getPhoneNumbers(){
    $.get("{{URL::to(app()->getLocale().'/get_phone')}}")
    .then((response)=>{
        numbers='';
        response.forEach(function(d){
            numbers+=`<div class="form-check form-radio-btn">
                            <input class="form-check-input" type="radio" name="phones[]" value="`+d.id+`">
                            <label class="form-check-label" for="condition">
                                `+d.phone+`
                            </label>
                        </div>`
        })
        numbers+=`<div class="invalid-feedback" id="phones_msg">
                  </div>`
        $('#phones').html(numbers);
    })
}
$(document).ready(function(){
    getPhoneNumbers();
})
</script>