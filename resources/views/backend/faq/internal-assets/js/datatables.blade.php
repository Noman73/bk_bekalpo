<script>

    
        var datatable= $('.data-table').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
          url:"{{route('admin.faq.create')}}"
        },
        columns:[
          {
            data:'DT_RowIndex',
            name:'DT_RowIndex',
            orderable:false,
            searchable:false
          },
          {
            data:'question',
            name:'question',
          },
          {
            data:'answer',
            name:'answer',
          },
          {
            data:'action',
            name:'action',
          }
        ]
    });
    
   window.formRequest= function(){
        $('#question').removeClass('is-invalid');
        let question=$('#question').val();
        let answer=$('#answer').val();
        let id=$('#id').val();
        let formData= new FormData();
        formData.append('question',question);
        formData.append('answer',answer);
        $('#exampleModalLabel').text('Update Faq');
        if(id!=''){
          formData.append('_method','PUT');
        }
        //axios post request
        if (id==''){
             axios.post("{{route('admin.faq.store')}}",formData)
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
          axios.post("{{URL::to('admin/faq/')}}/"+id,formData)
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
        $('#exampleModalLabel').text('Add New Faq');

    });
    $(document).delegate(".editRow", "click", function(){
        $('#exampleModalLabel').text('Update Faq');
        let route=$(this).data('url');
        axios.get(route)
        .then((data)=>{
          var editKeys=Object.keys(data.data);
          editKeys.forEach(function(key){
            if(key=='name'){
              $('#'+'sub_category_name').val(data.data[key]);
            }
            if(key=='category_id'){
              $('#category').val(data.data[key]).niceSelect('update');
            }
             $('#'+key).val(data.data[key]);
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
      $("textarea").val('');
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