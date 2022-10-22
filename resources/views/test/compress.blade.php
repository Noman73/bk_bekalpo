@extends('layouts.guest.master')
@section('content')
<input type="file" id="file" accept="image/*">
@endsection
@push('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.25.0/axios.min.js" integrity="sha512-/Q6t3CASm04EliI1QyIDAA/nDo9R8FQ/BULoUFyN4n/BDdyIxeH7u++Z+eobdmr11gG5D/6nPFyDlnisDwhpYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src="{{asset('storage/dependencies/compressor/compressor.js')}}"></script>
<script type="text/javascript">
  document.getElementById('file').addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) {
      return;
    }
    new Compressor(file,{
      quality: 0.5,
      // The compression process is asynchronous,
      // which means you have to access the `result` in the `success` hook function.
      success(result) {
        const formData = new FormData();
        // The third parameter is required for server
        formData.append('file', result, result.name);
        // Send the compressed image file to server with XMLHttpRequest.
        Jquery.post(url+'/testfile', formData)
        .then((res) => {
          console.log(res);
          console.log('Upload success');
        });
      },
      error(err) {
        console.log(err.message);
      },
    });
  });
</script>
@endpush


