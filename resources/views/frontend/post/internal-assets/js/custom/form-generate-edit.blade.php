<script>

function getBrand(status){
    category=$('#category').val();
    subcategory=$('#sub_category').val();
    console.log(category)
    if(category!='' && subcategory!=''){
        // console.log(url)
        $.get(url+'/get-data/'+category+'/'+subcategory)
        .then((response)=>{
            console.log(response)
            let brand="<option value=' '>- Select an Option -</option>"
            let feature="";
            let fueltype="";
            let item_type="<option value=''>- Select an Option -</option>"
            let bodytype="<option value=''>- Select an Option -</option>"
            let unittype="<option value=''>- Select an Option -</option>"
            let model="<option value=''>- Select an Option -</option>"
            response.brand.original.forEach(function(d){
                console.log(d['name_'+lang])
                brand+="<option value='"+d.id+"'>"+d['name_'+lang]+"</option>"
            })
            response.feature.original.forEach(function(d){
                feature+=`<div class="form-check form-check-box">
                            <input class="form-check-input" type="checkbox" name="feature[]" value="`+d.id+`">
                            <label class="form-check-label" for="`+d['name_'+lang]+`">`+d['name_'+lang]+`</label>
                         </div>`
            })
            response.fueltype.original.forEach(function(d){
                fueltype+=`<div class="form-check form-check-box">
                            <input class="form-check-input" type="checkbox" name="fueltype[]" value="`+d.id+`">
                            <label class="form-check-label" for="`+d['name_'+lang]+`">`+d['name_'+lang]+`</label>
                         </div>`
            })
            response.item.original.forEach(function(d){
                item_type+="<option value='"+d.id+"'>"+d['name_'+lang]+"</option>"
            })
            response.bodytype.original.forEach(function(d){
                bodytype+="<option value='"+d.id+"'>"+d['name_'+lang]+"</option>"
            })
            response.unittype.original.forEach(function(d){
                unittype+="<option value='"+d.id+"'>"+d['name_'+lang]+"</option>"
            })
            console.log(brand);
            FormArray(status,brand,feature,item_type,fueltype,bodytype,unittype);
            // console.log(getFeatures(status));
            });
    }
}
function FormArray(status=[],brand='',feature='',item_type='',fueltype='',bodytype='',unittype=''){
    data={
        price_type:`<div class="row" id="init_price_type">
                        <div class="col-sm-3">
                            <label class="control-label">
                                Price Type
                                <span>*</span>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <select class="form-control select-box" id="price_type">
                                    <option value="1">Fixed</option>
                                    <option value="2">Negotiable</option>
                                    <option value="3">On Call</option>
                                </select>
                                <div class="invalid-feedback" id="price_type_msg">
                                </div>
                            </div>
                        </div>
                    </div>`,
        condition:`<div class="row" id="init_condition">
                        <div class="col-sm-3">
                            <label class="control-label">
                                Condition
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio"  name="condition[]" value="1">
                                    <label class="form-check-label" for="condition">
                                        New
                                    </label>
                                </div>
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio" name="condition[]" value="2">
                                    <label class="form-check-label" for="condition">
                                        Used
                                    </label>
                                </div>
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio" name="condition[]" value="3">
                                    <label class="form-check-label" for="condition">
                                        Recondition
                                    </label>
                                </div>
                                <div class="invalid-feedback" id="condition_msg">
                                </div>
                            </div>
                        </div>
                    </div>`,

        transmission:`<div class="row" id="init_transmission">
                        <div class="col-sm-3">
                            <label class="control-label">
                                Transmission
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio"  name="transmission[]" value="1">
                                    <label class="form-check-label" for="transmission">
                                        Manual
                                    </label>
                                </div>
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio" name="transmission[]" value="2">
                                    <label class="form-check-label" for="transmission">
                                        Autometic
                                    </label>
                                </div>
                                <div class="form-check form-radio-btn">
                                    <input class="form-check-input" type="radio" name="transmission[]" value="3">
                                    <label class="form-check-label" for="transmission">
                                        Other Transmission
                                    </label>
                                </div>
                                <div class="invalid-feedback" id="transmission_msg">
                                </div>
                            </div>
                        </div>
                    </div>`,
            brand_id:`<div class="row" id="init_brand">
                        <div class="col-sm-3">
                            <label class="control-label">
                                Brand
                                <span>*</span>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <select class="form-control select-box" id="brand" name="brand">
                                    `+brand+`
                                </select>
                                <div class="invalid-feedback" id="brand_msg">
                                </div>
                            </div>
                        </div>
                    </div>`,
            model_id:`<div class="row" id="init_model">
                        <div class="col-sm-3">
                            <label class="control-label">
                                Model
                                <span>*</span>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <select class="form-control select-box" id="model">
                                </select>
                                <div class="invalid-feedback" id="model_msg">
                                </div>
                            </div>
                        </div>
                    </div>`,
            feature_id:`<div class="row" id="init_feature">
                        <div class="col-sm-3">
                            <label class="control-label">
                                Features
                                <span>*</span>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                    `+feature+`
                                <div class="invalid-feedback" id="feature_msg">
                                </div>
                            </div>
                        </div>
                    </div>`,
            fuel_type:`<div class="row" id="init_fueltype">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Fuel Type
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                        `+fueltype+`
                                    <div class="invalid-feedback" id="fuel_type_msg">
                                    </div>
                                </div>
                            </div>
                        </div>`,
            authenticity:`<div class="row" id="init_authenticity">
                                <div class="col-sm-3">
                                    <label class="control-label">
                                        Authenticity
                                        <span>*</span>
                                    </label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <div class="form-check form-radio-btn">
                                            <input class="form-check-input" type="radio" name="authenticity[]" value="1">
                                            <label class="form-check-label" for="exampleRadios3">
                                                Original
                                            </label>
                                        </div>
                                        <div class="form-check form-radio-btn">
                                            <input class="form-check-input" type="radio"  name="authenticity[]" value="2">
                                            <label class="form-check-label" for="exampleRadios4">
                                                Copy
                                            </label>
                                        </div>
                                        <div class="invalid-feedback" id="authenticity_msg">
                                        </div>
                                    </div>
                                </div>
                            </div>`,
            item_type:`<div class="row" id="init_item_type">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Item Type
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select class="form-control select-box" id='item_type'>
                                        `+item_type+`
                                    </select>
                                <div class="invalid-feedback" id="item_type_msg">
                                </div>
                                </div>
                            </div>
                        </div>`,
            body_type:`<div class="row" id="init_body_type">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Body Type
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <select class="form-control select-box" id='body_type'>
                                        `+bodytype+`
                                    </select>
                                    <div class="invalid-feedback" id="body_type_msg">
                                    </div>
                                </div>
                            </div>
                        </div>`,
            size:`<div class="row" id="init_size">
                    <div class="col-sm-3">
                        <label class="control-label">
                            Size
                            <span>*</span>
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="number" class="form-control" name="size" id="size">
                            <div class="invalid-feedback" id="size_msg">
                            </div>
                        </div>
                    </div>
                </div>`,
            run_kilo:`<div class="row" id="init_run_time">
                        <div class="col-sm-3">
                            <label class="control-label">
                                Run kilometres
                                <span>*</span>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="number" class="form-control" name="run_kilometre" id="run_kilometre">
                                <div class="invalid-feedback" id="run_kilometre_msg">
                                </div>
                            </div>
                        </div>
                    </div>`,
            capacity:`<div class="row" id="init_capacity">
                        <div class="col-sm-3">
                            <label class="control-label">
                                Capacity
                                <span>*</span>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="number" class="form-control" name="capacity" id="capacity">
                                <div class="invalid-feedback" id="capacity_msg">
                                </div>
                            </div>
                        </div>
                    </div>`,
            unit_id:`<div class="row" id="init_unit">
                        <div class="col-sm-3">
                            <label class="control-label">
                                Unit
                                <span>*</span>
                            </label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <select class="form-control select-box" id='unit_type'>
                                    `+unittype+`
                                </select>
                                <div class="invalid-feedback" id="unit_type_msg">
                                </div>
                            </div>
                        </div>
                    </div>`,
            adress:`<div class="row" id="init_adress">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Adress
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="adress" id="adress">
                                    <div class="invalid-feedback" id="adress_msg">
                                    </div>
                                </div>
                            </div>
                        </div>`,
                    trim:`<div class="row" id="init_trim">
                                <div class="col-sm-3">
                                    <label class="control-label">
                                        Edition/Trim
                                        <span>*</span>
                                    </label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="trim" id="trim">
                                        <div class="invalid-feedback" id="trim_msg">
                                        </div>
                                    </div>
                                </div>
                            </div>`,
        manufacture_year:`<div class="row" id="init_manufacture">
                            <div class="col-sm-3">
                                <label class="control-label">
                                    Manufacture Year
                                    <span>*</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="manufacture_year" id="manufacture_year">
                                    <div class="invalid-feedback" id="manufacture_year_msg">
                                    </div>
                                </div>
                            </div>
                        </div>`,
        registration_year:`<div class="row" id="init_manufacture">
                                <div class="col-sm-3">
                                    <label class="control-label">
                                        Registration Year
                                        <span>*</span>
                                    </label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="registration_year" id="registration_year">
                                        <div class="invalid-feedback" id="registration_year_msg">
                                        </div>
                                    </div>
                                </div>
                            </div>`,
            
    }
    let html="";
    for (const key in status) {
        console.log(status[key])
        html+=data[status[key]];
    }
    // console.log(html);
    $('#data-init').html(html);
    setValue(post)
}
</script>