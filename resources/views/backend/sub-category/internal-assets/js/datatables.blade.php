<script>

    
        var datatable= $('.data-table').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
          url:"{{route('admin.sub-category.create')}}"
        },
        columns:[
          {
            data:'DT_RowIndex',
            name:'DT_RowIndex',
            orderable:false,
            searchable:false
          },
          {
            data:'cat_name',
            name:'cat_name',
          },
          {
            data:'name_en',
            name:'name_en',
          },
          {
            data:'name_bn',
            name:'name_bn',
          },
          {
            data:'action',
            name:'action',
          }
        ]
    });
    
   window.formRequest= function(){
        $('#name').removeClass('is-invalid');
        let name_en=$('#sub_category_name_en').val();
        let name_bn=$('#sub_category_name_bn').val();
        let category=$('#category').val();
        let id=$('#id').val();
        let formData= new FormData();
        formData.append('sub_category_name_en',name_en);
        formData.append('sub_category_name_bn',name_bn);
        formData.append('category',category);

        $('#exampleModalLabel').text('Update Sub Category');
        if(id!=''){
          formData.append('_method','PUT');
        }
        //axios post request
        if (id==''){
             axios.post("{{route('admin.sub-category.store')}}",formData)
            .then(function (response){
                if(response.data.message){
                    toastr.success(response.data.message)
                    datatable.ajax.reload();
                    clear();
                    $('#exampleModal').modal('hide');
                }else if(response.data.error){
                  var keys=Object.keys(response.data.error);
                  keys.forEach(function(d){
                    $('#'+d).addClass('is-invalid');
                    $('#'+d+'_msg').text(response.data.error[d][0]);
                  })
                }
            })
        }else{
          axios.post("{{URL::to('admin/sub-category/')}}/"+id,formData)
            .then(function (response){
              if(response.data.message){
                  toastr.success(response.data.message);
                  datatable.ajax.reload();
                  clear();
              }else if(response.data.error){
                  var keys=Object.keys(response.data.error);
                  keys.forEach(function(d){
                    $('#'+d).addClass('is-invalid')
                    $('#'+d+'_msg').text(response.data.error[d][0]);
                  })
                }
            })
        }
    }
    $(document).delegate("#modalBtn", "click", function(event){
        clear();
        $('#exampleModalLabel').text('Add New Sub Category');

    });
    $(document).delegate(".editRow", "click", function(){
        $('#exampleModalLabel').text('Update Sub Category');
        let route=$(this).data('url');
        axios.get(route)
        .then((data)=>{
          var editKeys=Object.keys(data.data);
          editKeys.forEach(function(key){
            if(key=='name_en'){
              $('#'+'sub_category_name_en').val(data.data[key]);
            }
            if(key=='name_bn'){
              $('#'+'sub_category_name_bn').val(data.data[key]);
            }
            if(key=='category_id'){
              console.log(data.data[key])
              $('#category').val(data.data[key]).niceSelect('update');
            }
            //  $('#'+key).val(data.data[key]);
             $('#exampleModal').modal('show');
             $('#id').val(data.data.id);
          })
        })
    });
    $(document).delegate(".deleteRow", "click", function(){
        let route=$(this).data('url');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value==true) {
            axios.delete(route)
            .then((data)=>{
              if(data.data.message){
                toastr.success(data.data.message);
                datatable.ajax.reload();
              }else if(data.data.warning){
                toastr.error(data.data.warning);
              }
            })
          }
        })
    });
    function clear(){
      $("input").removeClass('is-invalid').val('');
      $(".invalid-feedback").text('');
      $('select').val('').niceSelect('update')
    }

  //   $('#category').select2({
  //   theme:'bootstrap4',
  //   placeholder:'select',
  //   allowClear:true,
  //   ajax:{
  //     url:"{{route('admin.category.getdata')}}",
  //     type:'post',
  //     dataType:'json',
  //     delay:20,
  //     data:function(params){
  //       return {
  //         searchTerm:params.term,
  //         _token:"{{csrf_token()}}",
  //         }
  //     },
  //     processResults:function(response){
  //       return {
  //         results:response,
  //       }
  //     },
  //     cache:true,
  //   }
  // })
    </script>