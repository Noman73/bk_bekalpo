<script>
    var datatable= $('.data-table').DataTable({
      processing:true,
      serverSide:true,
      ajax:{
        url:"{{route('admin.cities.create')}}"
      },
      columns:[
        {
          data:'DT_RowIndex',
          name:'DT_RowIndex',
          orderable:false,
          searchable:false
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
  
  function formRequest(){
      $('#name_en').removeClass('is-invalid');
      let name_en=$('#name_en').val();
      let name_bn=$('#name_bn').val();
      let id=$('#id').val();
      let formData= new FormData();
      formData.append('name_en',name_en);
      formData.append('name_bn',name_bn);
      if(id!=''){
        formData.append('_method','PUT');
        $('#exampleModalLabel').text('Update Cities');
      }

      //axios post request
      if (id==''){
           axios.post("{{route('admin.cities.store')}}",formData)
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
        axios.post("{{URL::to('admin/cities/')}}/"+id,formData)
          .then(function (response){
            if(response.data.message){
                toastr.success(response.data.message);
                datatable.ajax.reload();
                clear();
                $('#exampleModal').modal('hide');
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
  });
  $(document).delegate(".editRow", "click", function(){
      let route=$(this).data('url');
      axios.get(route)
      .then((data)=>{
        var editKeys=Object.keys(data.data);
        editKeys.forEach(function(key){
            if(key=='icon'){
                // console.log('okkkkk')
                $('form select').val(data.data[key]);
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
    $(".invalid-feedback").text('');
    $('form select').val('').niceSelect('update');
    $('#exampleModalLabel').text('Add New Cities');
  }
  </script>