<div class="modal fade locationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <a onclick="backModal()" href="javascript:void(0)"><i class="fa fa-angle-left mr-3 d-none" id="back-button"></i></a><p class="modal-title" id="exampleModalLongTitle"><strong>Location</strong> </p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{-- content start --}}
      <div class="row">
        
        <div class="col-md-6 mt-3 col-12" id="left-part">
          <span class="m-3"><strong>Select City or Division</strong></span>

          <ul class="list-group list-group-flush text-color">
            <span class="m-3 text-dark">Cities</span>
            <li onclick="allOfBangladesh()" class="list-group-item color">All of Bangladesh </li>
            @php
            $lang_name="name_".app()->getLocale();
            @endphp
            @foreach($division as $div)
            <li onclick="cities({{$div->id}},'{{$div->$lang_name}}')" class="list-group-item color">{{$div->$lang_name}} <i class="fa fa-angle-right mt-1 float-right"></i></li>
            @endforeach
            <span class="m-3 text-dark">Divisions</span>
            @foreach($division as $div)
            <li onclick="areas({{$div->id}},'{{$div->$lang_name}}')" class="list-group-item color">{{$div->$lang_name}} Division <i class="fa fa-angle-right mt-1 float-right"></i></li>
            @endforeach
          </ul>
        </div>
        <div class="col-md-6 mt-3 col-12" id="right-part">

        </div>
      </div>
      
      {{-- end --}}
    </div>
  </div>
</div>
