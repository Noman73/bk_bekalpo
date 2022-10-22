<script>
var data;

var sort={
    highToLow:null,
    lowToHigh:null,
    aToZ:null,
    zToA:null,
}
var ad_type=null;
var subcat=null;
var category=null;
var min_price=null;
var high_price=null;
var city=null;
var loc=null;
var search=null;
var condition=null;
var brand=null;
var manufacture_min=null;
var manufacture_max=null;
var transmission=null;
var body_type=null;
var kilometer_run_min=null;
var kilometer_run_max=null;
var model=null;// new filter
var authenticity=null;
var item_type=null;
var token="{{csrf_token()}}";
    $(document).ready(function(){
        filter();
    })
function filter(){
    // $("#preloader").fadeIn();
    $.post("{{URL::to('/post-data')}}",{_token:token,sort:sort,ad_type:ad_type,category:category,subcat:subcat,min_price:min_price,high_price,city:city,location:loc,search:search,condition:condition,brand:brand,manufacture_min:manufacture_min,manufacture_max:manufacture_max,transmission:transmission,body_type:body_type,kilometer_run_min:kilometer_run_min,kilometer_run_max:kilometer_run_max,model:model,authenticity:authenticity,item_type:item_type})
        .then(response=>{
            $('#posts-all').html(response);
            $("#not-found").empty();
            $('#item-title-header').text($('#item-title').val())
            if(response==""){
                msg="<h5 class='text-center content-justify-center text-danger'>No Ad Found</h5>"
                $('#not-found').html(msg);
                $('#item-title-header').text('')
            }
            featurePost()
        })
}
function featurePost(){
    $.post("{{URL::to('/featured-post')}}",{category:category,subcat:subcat,_token:token})
        .then(response=>{
            $('#posts-feature').html(response);
            $('#item-title-header').text($('#item-title').val())
        })
}
function lowToHigh(){
    sort.highToLow=null;
    sort.lowToHigh=1;
    sort.aToZ=null;
    sort.zToA=null;
    filter();
}
function highToLow(){
    sort.highToLow=1;
    sort.lowToHigh=null;
    sort.aToZ=null;
    sort.zToA=null;
    filter();
}
function aToZ(){
    sort.highToLow=null;
    sort.lowToHigh=null;
    sort.aToZ=1;
    sort.zToA=null;
    filter();
}
function zToA(){
    sort.highToLow=null;
    sort.lowToHigh=null;
    sort.aToZ=null;
    sort.zToA=1;
    filter();
}

function adType(val){
    ad_type=val;
    filter();
}
function subcategories(val){
    subcat=val;
    $.get("{{URL::to('/get-brand')}}/"+subcat)
        .then(response=>{
            let brand="<option value=''>- Select an Option -</option>";
            response.forEach(function(d){
                brand+="<option value='"+d.id+"'>"+d.name+" ("+d.posts_count+")</option>";
            })
            $('#brand').html(brand);
            if(response.length>0){
                $('#subcategory_filter').removeClass('d-none')
            }
        })
    $.get("{{URL::to('/get-bodytype')}}/"+subcat)
        .then(response=>{
            let bodytype="<option value=''>- Select an Option -</option>";
            response.forEach(function(d){
                bodytype+="<option value='"+d.id+"'>"+d.name+"</option>";
            })
            $('#body_type').html(bodytype);
        })
    $.get("{{URL::to('/get-itemtype')}}/"+subcat)
        .then(response=>{
            let itemtype="<option value=''>- Select an Option -</option>";
            response.forEach(function(d){
                itemtype+="<option value='"+d.id+"'>"+d.name+"</option>";
            })
            $('#item_type').html(itemtype);
        })
    $.get("{{URL::to('/field-permission')}}/"+subcat)
        .then(response=>{
            fields=[];
            response.forEach(function(d){ 
                fields.push(d.field_name)
            })
            setTimeout(() => {
                if(fields.includes('brand_id')){
                    $('#brand_filter').removeClass('d-none');
                }else{
                    $('#brand_filter').addClass('d-none');
                }
                if(fields.includes('model_id')){
                    $('#model_filter').removeClass('d-none');
                }else{
                    $('#model_filter').addClass('d-none');
                }
                if(fields.includes('authenticity')){
                    $('#authenticity_filter').removeClass('d-none');
                }else{
                    $('#authenticity_filter').addClass('d-none');
                }
                if(fields.includes('item_type')){
                    $('#item_type_filter').removeClass('d-none');
                }else{
                    $('#item_type_filter').addClass('d-none');
                }
                if(fields.includes('manufacture_year')){
                    $('#manufacture_year_filter').removeClass('d-none');
                }else{
                    $('#manufacture_year_filter').addClass('d-none');
                }
                if(fields.includes('transmission')){
                    $('#transmission_filter').removeClass('d-none');
                }else{
                    $('#transmission_filter').addClass('d-none');
                }
                if(fields.includes('body_type')){
                    $('#body_type_filter').removeClass('d-none');
                }else{
                    $('#body_type_filter').addClass('d-none');
                }
                if(fields.includes('run_kilo')){
                    $('#kilometer_run_filter').removeClass('d-none');
                }else{
                    $('#kilometer_run_filter').addClass('d-none');
                }
            }, 200);
        })
    filter();
}
function locaTion(val,name){
    loc=val;
    $('#locationModal').text(name);
    $('.locationModal').modal('hide');
    setTimeout(() => {
        $('.locationModal').remove();
    },250)
    filter();
}
function searchs(val){
    search=val;
    filter();
}
function categories(this_val){
    category=$(this_val).val();
    text=$(this_val).find('option:selected').text();
    text=text.split('(');
    $.get("{{URL::to('get-subcategory/')}}/"+category)
        .then(response=>{
            let brand="<option value=''>All "+text[0]+"</option>";
            response.forEach(function(d){
                brand+="<option value='"+d.id+"'>"+d.name+" ("+d.posts_count+")</option>";
            })
            $('#subcategory').html(brand);
            if(response.length>0){
                $('#subcategory_filter').removeClass('d-none')
            }
    })
    filter();
}
function conditions(val){
    condition=val;
    filter();
}

function minPrice(val){
  min_price=val;
}
function maxPrice(val){
   high_price=val;
}
function brands(val){
   brand=val;
   filter();
}
function models(val){
    model=val;
    filter();
}
function itemtype(val){
    item_type=val;
    filter();
}
function authenticities(val){
    authenticity=val;
    filter();
}
function minManufacture(val){
    manufacture_min=val;
}
function maxManufacture(val){
    manufacture_max=val;
}
function transmissions(val){
    transmission=val;
    filter();
}
function kilometreRunMin(val){
    kilometer_run_min=val;
}
function kilometreRunMax(val){
    kilometer_run_max=val;
}
function bodytype(val){
    body_type=val;
}
function kilometreRun(val){
    kilometer_run=val;
}

function reset(){
    sort.highToLow=null;
    sort.lowToHigh=null;
    sort.aToZ=null;
    sort.zToA=null;
    ad_type=null;
    subcat=null;
    min_price=null;
    high_price=null;
    city=null;
    loc=null;
    condition=null;
    brand=null;
    manufacture_min=null;
    manufacture_max=null;
    transmission=null;
    body_type=null;
    kilometer_run_min=null;
    kilometer_run_max=null;
    model=null;// new filter
    authenticity=null;
    item_type=null;
    $('#max').val('');
    $('#min').val('');
    $("input[type='radio']").attr('checked',false);
    filter();
}
function allOfBangladesh(){
    city=null;
    loc=null;
    $('#locationModal').text('Location');
    $('.locationModal').modal('hide');
}
$(document).on('click','.pagination a',function(e){
    e.preventDefault()
    let link=$(this).attr('href')
    let page=link.split('page=')[1];
    $.post("{{URL::to('/post-data')}}?page="+page,{_token:token,sort:sort,ad_type:ad_type,subcat:subcat,min_price:min_price,high_price,location:loc,condition:condition})
    .then(response=>{
            $('#posts-all').html(response);
            $("#not-found").empty();
            $('#item-title-header').text($('#item-title').val())
            if(response==""){
                msg="<h5 class='text-center content-justify-center text-danger'>No Ad Found</h5>"
                $('#not-found').html(msg);
                $('#item-title-header').text('')
            }
        
    })
})
$(document).on('click','#apply-filter',function(e){
    e.preventDefault()
    filter();
})
$(document).on('click','#keyword-btn',function(){
    var e = jQuery.Event("keypress");
    e.which=13;
    $("#keyword").trigger(e);
})
$('#keyword').keypress(function(event){
    // event.preventDefault();
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        event.preventDefault();
        this_val=$(this).val()
        if (typeof (history.pushState) != "undefined") {
            var obj = { Title: 'buy sell', Url: url+'/ads?keyword='+this_val };
            history.pushState(obj, obj.Title, obj.Url);
            if($('#cities').val()!=null){
                city=$('#cities').val();
            }
            if($('#area').val()!=null){
                loc=$('#area').val();
            }
            searchs($(this).val());
        }
    }
});

$(document).ready(function(){
    let searchParams = new URLSearchParams(window.location.search);
    if(searchParams.has('keyword')){
        search=searchParams.get('keyword');
        $('#keyword').val(search);
        setTimeout(() => {
            filter();
        }, 250);
    }
    if(searchParams.has('category')){
        category=searchParams.get('category');
        setTimeout(() => {
            filter();
        }, 250);
    }
    if(searchParams.has('subcategory')){
        subcat=searchParams.get('subcategory');
        setTimeout(() => {
            filter();
        }, 250);
    }
})

function cities(val,divname){
    city=val;
    let division=val;
        if(division!=''){
            $.get("{{URL::to('/get-city-location')}}/"+division)
            .then(response=>{
                let location=`<span class="m-3"><strong>Select a local area in `+divname+`
                              </strong></span><ul class='list-group list-group-flush text-color'>`;
                    location+=`<li onclick="allCities(`+division+`,'`+String(divname)+`')" class='list-group-item color'>All Of `+divname+` <i class='fa fa-angle-right mt-1 float-right'></i></li>`;
                response.forEach(function(d){
                    location+=`<li onclick="locaTion(`+d.id+`,'`+String(d.name)+`')" class='list-group-item color'>`+d.name+` <i class='fa fa-angle-right mt-1 float-right'></i></li>`;
                    // location+="<option value='"+d.id+"'>"+d.name+"</option>";
                })
                location+="</ul>"
                $('#right-part').html(location);
            })
        }
        modalResponsive();
        filter();
}
function allCities(val,name){
    city=val;
    loc=null;
    $('#locationModal').text(name);
    $('.locationModal').modal('hide');
    setTimeout(() => {
        $('.locationModal').remove();
    },250)
    filter();
}
function areas(val,divname){
    city=val;
    let division=val;
        if(division!=''){
            $.get("{{URL::to('/get-area-location')}}/"+division)
            .then(response=>{
                let location=`<span class="m-3"><strong>Select a local area in `+divname+`
                              </strong></span><ul class='list-group list-group-flush text-color'>`;
                    location+=`<li onclick="allAreas(`+division+`,'`+String(divname)+` Division')" class='list-group-item color'>All Of `+divname+` Division<i class='fa fa-angle-right mt-1 float-right'></i></li>`;
                response.forEach(function(d){
                    location+=`<li onclick="locaTion(`+d.id+`,'`+String(d.name)+`')" class='list-group-item color'>`+d.name+` <i class='fa fa-angle-right mt-1 float-right'></i></li>`;
                    // location+="<option value='"+d.id+"'>"+d.name+"</option>";
                })
                location+="</ul>"
                $('#right-part').html(location);
            })
        }
        modalResponsive();
        filter();
}
function allAreas(val,name){
    city=val;
    loc=null;
    $('#locationModal').text(name);
    $('.locationModal').modal('hide');
    setTimeout(() => {
        $('.locationModal').remove();
    },250)
    filter();
}
    $(document).on('change','#brand',function(){
        let brand=$(this).val();
        if(brand!=''){
            $.get("{{URL::to('/get-model')}}/"+brand)
            .then(response=>{
                let brand="<option value=''>- Select a Model -</option>";
                response.forEach(function(d){
                    brand+="<option value='"+d.id+"'>"+d.name+" ("+d.posts_count+")</option>";
                })
                $('#model').html(brand);
            })
        }
    });
    $(document).on('click','#locationModal',function(){
            $.get("{{URL::to('/get-location-modal')}}")
            .then(response=>{
               $('#renderModal').html(response);
               $('.locationModal').modal('show');
            })
    });
</script>
@include('frontend.modal.location.internal-assets.js.script')