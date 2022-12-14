<script>
  var datatable= $('.data-table').DataTable({
    processing:true,
    serverSide:true,
    ajax:{
      url:"{{route('admin.package.create')}}"
    },
    columns:[
      {
        data:'DT_RowIndex',
        name:'DT_RowIndex',
        orderable:false,
        searchable:false
      },
      {
        data:'name',
        name:'name',
      },
	  {
        data:'icon',
        name:'icon',
      },
      {
        data:'action',
        name:'action',
      }
    ]
});

function formRequest(){
    $('#name').removeClass('is-invalid');
    let name=$('#name').val();
    let price=$('#price').val();
    let days=$('#days').val();
    let icon=$('form select').val();
    let id=$('#id').val();
    let formData= new FormData();
    formData.append('name',name);
    formData.append('icon',icon);
    formData.append('days',days);
    formData.append('price',price);
    if(id!=''){
      formData.append('_method','PUT');
      $('#exampleModalLabel').text('Update package');
    }else{
      $('#exampleModalLabel').text('Add New package');
    }
    //axios post request
    if (id==''){
         axios.post("{{route('admin.package.store')}}",formData)
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
      axios.post("{{URL::to('admin/package/')}}/"+id,formData)
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
			//   console.log('okkkkk')
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
  $('form select').val('').niceSelect('update')
}

var fontAwesome = {};
		fontAwesome["fa-adjust"] = "f042";
		fontAwesome["fa-adn"] = "f170";
		fontAwesome["fa-align-center"] = "f037";
		fontAwesome["fa-align-justify"] = "f039";
		fontAwesome["fa-align-left"] = "f036";
		fontAwesome["fa-align-right"] = "f038";
		fontAwesome["fa-ambulance"] = "f0f9";
		fontAwesome["fa-anchor"] = "f13d";
		fontAwesome["fa-android"] = "f17b";
		fontAwesome["fa-angellist"] = "f209";
		fontAwesome["fa-angle-double-down"] = "f103";
		fontAwesome["fa-angle-double-left"] = "f100";
		fontAwesome["fa-angle-double-right"] = "f101";
		fontAwesome["fa-angle-double-up"] = "f102";
		fontAwesome["fa-angle-down"] = "f107";
		fontAwesome["fa-angle-left"] = "f104";
		fontAwesome["fa-angle-right"] = "f105";
		fontAwesome["fa-angle-up"] = "f106";
		fontAwesome["fa-apple"] = "f179";
		fontAwesome["fa-archive"] = "f187";
		fontAwesome["fa-area-chart"] = "f1fe";
		fontAwesome["fa-arrow-circle-down"] = "f0ab";
		fontAwesome["fa-arrow-circle-left"] = "f0a8";
		fontAwesome["fa-arrow-circle-o-down"] = "f01a";
		fontAwesome["fa-arrow-circle-o-left"] = "f190";
		fontAwesome["fa-arrow-circle-o-right"] = "f18e";
		fontAwesome["fa-arrow-circle-o-up"] = "f01b";
		fontAwesome["fa-arrow-circle-right"] = "f0a9";
		fontAwesome["fa-arrow-circle-up"] = "f0aa";
		fontAwesome["fa-arrow-down"] = "f063";
		fontAwesome["fa-arrow-left"] = "f060";
		fontAwesome["fa-arrow-right"] = "f061";
		fontAwesome["fa-arrow-up"] = "f062";
		fontAwesome["fa-arrows"] = "f047";
		fontAwesome["fa-arrows-alt"] = "f0b2";
		fontAwesome["fa-arrows-h"] = "f07e";
		fontAwesome["fa-arrows-v"] = "f07d";
		fontAwesome["fa-asterisk"] = "f069";
		fontAwesome["fa-at"] = "f1fa";
		fontAwesome["fa-backward"] = "f04a";
		fontAwesome["fa-ban"] = "f05e";
		fontAwesome["fa-bar-chart"] = "f080";
		fontAwesome["fa-barcode"] = "f02a";
		fontAwesome["fa-bars"] ="f0c9";
		fontAwesome["fa-beer"] ="f0fc";
		fontAwesome["fa-behance"] ="f1b4";
		fontAwesome["fa-behance-square"] = "f1b5";
		fontAwesome["fa-bell"] = "f0f3";
		fontAwesome["fa-bell-o"] = "f0a2";
		fontAwesome["fa-bell-slash"] = "f1f6";
		fontAwesome["fa-bell-slash-o"] = "f1f7";
		fontAwesome["fa-bicycle"] = "f206";
		fontAwesome["fa-binoculars"] = "f1e5";
		fontAwesome["fa-birthday-cake"] = "f1fd";
		fontAwesome["fa-bitbucket"] = "f171";
		fontAwesome["fa-bitbucket-square"] = "f172";
		fontAwesome["fa-bold"] = "f032";
		fontAwesome["fa-bolt"] = "f0e7";
		fontAwesome["fa-bomb"] = "f1e2";
		fontAwesome["fa-book"] = "f02d";
		fontAwesome["fa-bookmark"] = "f02e";
		fontAwesome["fa-bookmark-o"] = "f097";
		fontAwesome["fa-briefcase"] = "f0b1";
		fontAwesome["fa-btc"] = "f15a";
		fontAwesome["fa-bug"] = "f188";
		fontAwesome["fa-building"] = "f1ad";
		fontAwesome["fa-building-o"] = "f0f7";
		fontAwesome["fa-bullhorn"] = "f0a1";
		fontAwesome["fa-bullseye"] = "f140";
		fontAwesome["fa-bus"] = "f207";
		fontAwesome["fa-calculator"] = "f1ec";
		fontAwesome["fa-calendar"] = "f073";
		fontAwesome["fa-calendar-o"] = "f133";
		fontAwesome["fa-camera"] = "f030";
		fontAwesome["fa-camera-retro"] = "f083";
		fontAwesome["fa-car"] = "f1b9";
		fontAwesome["fa-caret-down"] = "f0d7";
		fontAwesome["fa-caret-left"] = "f0d9";
		fontAwesome["fa-caret-right"] = "f0da";
		fontAwesome["fa-caret-square-o-down"] = "f150";
		fontAwesome["fa-caret-square-o-left"] = "f191";
		fontAwesome["fa-caret-square-o-right"] = "f152";
		fontAwesome["fa-caret-square-o-up"] = "f151";
		fontAwesome["fa-caret-up"] = "f0d8";
		fontAwesome["fa-cc"] = "f20a";
		fontAwesome["fa-cc-amex"] = "f1f3";
		fontAwesome["fa-cc-discover"] = "f1f2";
		fontAwesome["fa-cc-mastercard"] = "f1f1";
		fontAwesome["fa-cc-paypal"] = "f1f4";
		fontAwesome["fa-cc-stripe"] = "f1f5";
		fontAwesome["fa-cc-visa"] = "f1f0";
		fontAwesome["fa-certificate"] = "f0a3";
		fontAwesome["fa-chain-broken"] = "f127";
		fontAwesome["fa-check"] = "f00c";
		fontAwesome["fa-check-circle"] = "f058";
		fontAwesome["fa-check-circle-o"] = "f05d";
		fontAwesome["fa-check-square"] = "f14a";
		fontAwesome["fa-check-square-o"] = "f046";
		fontAwesome["fa-chevron-circle-down"] = "f13a";
		fontAwesome["fa-chevron-circle-left"] = "f137";
		fontAwesome["fa-chevron-circle-right"] = "f138";
		fontAwesome["fa-chevron-circle-up"] = "f139";
		fontAwesome["fa-chevron-down"] = "f078";
		fontAwesome["fa-chevron-left"] = "f053";
		fontAwesome["fa-chevron-right"] = "f054";
		fontAwesome["fa-chevron-up"] = "f077";
		fontAwesome["fa-child"] = "f1ae";
		fontAwesome["fa-circle"] = "f111";
		fontAwesome["fa-circle-o"] = "f10c";
		fontAwesome["fa-circle-o-notch"] = "f1ce";
		fontAwesome["fa-circle-thin"] = "f1db";
		fontAwesome["fa-clipboard"] = "f0ea";
		fontAwesome["fa-clock-o"] = "f017";
		fontAwesome["fa-cloud"] = "f0c2";
		fontAwesome["fa-cloud-download"] = "f0ed";
		fontAwesome["fa-cloud-upload"] = "f0ee";
		fontAwesome["fa-code"] = "f121";
		fontAwesome["fa-code-fork"] = "f126";
		fontAwesome["fa-codepen"] = "f1cb";
		fontAwesome["fa-coffee"] = "f0f4";
		fontAwesome["fa-cog"] = "f013";
		fontAwesome["fa-cogs"] = "f085";
		fontAwesome["fa-columns"] = "f0db";
		fontAwesome["fa-comment"] = "f075";
		fontAwesome["fa-comment-o"] = "f0e5";
		fontAwesome["fa-comments"] = "f086";
		fontAwesome["fa-comments-o"] = "f0e6";
		fontAwesome["fa-compass"] = "f14e";
		fontAwesome["fa-compress"] = "f066";
		fontAwesome["fa-copyright"] = "f1f9";
		fontAwesome["fa-credit-card"] = "f09d";
		fontAwesome["fa-crop"] = "f125";
		fontAwesome["fa-crosshairs"] = "f05b";
		fontAwesome["fa-css3"] = "f13c";
		fontAwesome["fa-cube"] = "f1b2";
		fontAwesome["fa-cubes"] = "f1b3";
		fontAwesome["fa-cutlery"] = "f0f5";
		fontAwesome["fa-database"] = "f1c0";
		fontAwesome["fa-delicious"] = "f1a5";
		fontAwesome["fa-desktop"] = "f108";
		fontAwesome["fa-deviantart"] = "f1bd";
		fontAwesome["fa-digg"] = "f1a6";
		fontAwesome["fa-dot-circle-o"] = "f192";
		fontAwesome["fa-download"] = "f019";
		fontAwesome["fa-dribbble"] = "f17d";
		fontAwesome["fa-dropbox"] = "f16b";
		fontAwesome["fa-drupal"] = "f1a9";
		fontAwesome["fa-eject"] = "f052";
		fontAwesome["fa-ellipsis-h"] = "f141";
		fontAwesome["fa-ellipsis-v"] = "f142";
		fontAwesome["fa-empire"] = "f1d1";
		fontAwesome["fa-envelope"] = "f0e0";
		fontAwesome["fa-envelope-o"] = "f003";
		fontAwesome["fa-envelope-square"] = "f199";
		fontAwesome["fa-eraser"] = "f12d";
		fontAwesome["fa-eur"] = "f153";
		fontAwesome["fa-exchange"] = "f0ec";
		fontAwesome["fa-exclamation"] = "f12a";
		fontAwesome["fa-exclamation-circle"] = "f06a";
		fontAwesome["fa-exclamation-triangle"] = "f071";
		fontAwesome["fa-expand"] = "f065";
		fontAwesome["fa-external-link"] = "f08e";
		fontAwesome["fa-external-link-square"] = "f14c";
		fontAwesome["fa-eye"] = "f06e";
		fontAwesome["fa-eye-slash"] = "f070";
		fontAwesome["fa-eyedropper"] = "f1fb";
		fontAwesome["fa-facebook"] = "f09a";
		fontAwesome["fa-facebook-square"] = "f082";
		fontAwesome["fa-fast-backward"] = "f049";
		fontAwesome["fa-fast-forward"] = "f050";
		fontAwesome["fa-fax"] = "f1ac";
		fontAwesome["fa-female"] = "f182",
		fontAwesome["fa-fighter-jet"] = "f0fb";
		fontAwesome["fa-file"] = "f15b";
		fontAwesome["fa-file-archive-o"] = "f1c6";
		fontAwesome["fa-file-audio-o"] = "f1c7";
		fontAwesome["fa-file-code-o"] = "f1c9";
		fontAwesome["fa-file-excel-o"] = "f1c3";
		fontAwesome["fa-file-image-o"] = "f1c5";
		fontAwesome["fa-file-o"] = "f016";
		fontAwesome["fa-file-pdf-o"] = "f1c1";
		fontAwesome["fa-file-powerpoint-o"] = "f1c4";
		fontAwesome["fa-file-text"] = "f15c";
		fontAwesome["fa-file-text-o"] = "f0f6";
		fontAwesome["fa-file-video-o"] = "f1c8";
		fontAwesome["fa-file-word-o"] = "f1c2";
		fontAwesome["fa-files-o"] = "f0c5";
		fontAwesome["fa-film"] = "f008";
		fontAwesome["fa-filter"] = "f0b0";
		fontAwesome["fa-fire"] = "f06d";
		fontAwesome["fa-fire-extinguisher"] = "f134";
		fontAwesome["fa-flag"] = "f024";
		fontAwesome["fa-flag-checkered"] = "f11e";
		fontAwesome["fa-flag-o"] = "f11d";
		fontAwesome["fa-flask"] = "f0c3";
		fontAwesome["fa-flickr"] = "f16e";
		fontAwesome["fa-floppy-o"] = "f0c7";
		fontAwesome["fa-folder"] = "f07b";
		fontAwesome["fa-folder-o"] = "f114";
		fontAwesome["fa-folder-open"] = "f07c";
		fontAwesome["fa-folder-open-o"] = "f115";
		fontAwesome["fa-font"] = "f031";
		fontAwesome["fa-forward"] = "f04e";
		fontAwesome["fa-foursquare"] = "f180";
		fontAwesome["fa-frown-o"] = "f119";
		fontAwesome["fa-futbol-o"] = "f1e3";
		fontAwesome["fa-gamepad"] = "f11b";
		fontAwesome["fa-gavel"] = "f0e3";
		fontAwesome["fa-gbp"] = "f154";
		fontAwesome["fa-gift"] = "f06b";
		fontAwesome["fa-git"] = "f1d3";
		fontAwesome["fa-git-square"] = "f1d2";
		fontAwesome["fa-github"] = "f09b";
		fontAwesome["fa-github-alt"] = "f113";
		fontAwesome["fa-github-square"] = "f092";
		fontAwesome["fa-gittip"] = "f184";
		fontAwesome["fa-glass"] = "f000";
		fontAwesome["fa-globe"] = "f0ac";
		fontAwesome["fa-google"] = "f1a0";
		fontAwesome["fa-google-plus"] = "f0d5";
		fontAwesome["fa-google-plus-square"] = "f0d4";
		fontAwesome["fa-google-wallet"] = "f1ee";
		fontAwesome["fa-graduation-cap"] = "f19d";
		fontAwesome["fa-h-square"] = "f0fd";
		fontAwesome["fa-hacker-news"] = "f1d4";
		fontAwesome["fa-hand-o-down"] = "f0a7";
		fontAwesome["fa-hand-o-left"] = "f0a5";
		fontAwesome["fa-hand-o-right"] = "f0a4";
		fontAwesome["fa-hand-o-up"] = "f0a6";
		fontAwesome["fa-hdd-o"] = "f0a0";
		fontAwesome["fa-header"] = "f1dc";
		fontAwesome["fa-headphones"] = "f025";
		fontAwesome["fa-heart"] = "f004";
		fontAwesome["fa-heart-o"] = "f08a";
		fontAwesome["fa-history"] = "f1da";
		fontAwesome["fa-home"] = "f015";
		fontAwesome["fa-hospital-o"] = "f0f8";
		fontAwesome["fa-html5"] = "f13b";
		fontAwesome["fa-ils"] = "f20b";
		fontAwesome["fa-inbox"] = "f01c";
		fontAwesome["fa-indent"] = "f03c";
		fontAwesome["fa-info"] = "f129";
		fontAwesome["fa-info-circle"] = "f05a";
		fontAwesome["fa-inr"] = "f156";
		fontAwesome["fa-instagram"] = "f16d";
		fontAwesome["fa-ioxhost"] = "f208";
		fontAwesome["fa-italic"] = "f033";
		fontAwesome["fa-joomla"] = "f1aa";
		fontAwesome["fa-jpy"] = "f157";
		fontAwesome["fa-jsfiddle"] = "f1cc";
		fontAwesome["fa-key"] = "f084";
		fontAwesome["fa-keyboard-o"] = "f11c";
		fontAwesome["fa-krw"] = "f159";
		fontAwesome["fa-language"] = "f1ab";
		fontAwesome["fa-laptop"] = "f109";
		fontAwesome["fa-lastfm"] = "f202";
		fontAwesome["fa-lastfm-square"] = "f203";
		fontAwesome["fa-leaf"] = "f06c";
		fontAwesome["fa-lemon-o"] = "f094";
		fontAwesome["fa-level-down"] = "f149";
		fontAwesome["fa-level-up"] = "f148";
		fontAwesome["fa-life-ring"] = "f1cd";
		fontAwesome["fa-lightbulb-o"] = "f0eb";
		fontAwesome["fa-line-chart"] = "f201";
		fontAwesome["fa-link"] = "f0c1";
		fontAwesome["fa-linkedin"] = "f0e1";
		fontAwesome["fa-linkedin-square"] = "f08c";
		fontAwesome["fa-linux"] = "f17c";
		fontAwesome["fa-list"] = "f03a";
		fontAwesome["fa-list-alt"] = "f022";
		fontAwesome["fa-list-ol"] = "f0cb";
		fontAwesome["fa-list-ul"] = "f0ca";
		fontAwesome["fa-location-arrow"] = "f124";
		fontAwesome["fa-lock"] = "f023";
		fontAwesome["fa-long-arrow-down"] = "f175";
		fontAwesome["fa-long-arrow-left"] = "f177";
		fontAwesome["fa-long-arrow-right"] = "f178";
		fontAwesome["fa-long-arrow-up"] = "f176";
		fontAwesome["fa-magic"] = "f0d0";
		fontAwesome["fa-magnet"] = "f076";
		fontAwesome["fa-male"] = "f183";
		fontAwesome["fa-map-marker"] = "f041";
		fontAwesome["fa-maxcdn"] = "f136";
		fontAwesome["fa-meanpath"] = "f20c";
		fontAwesome["fa-medkit"] = "f0fa";
		fontAwesome["fa-meh-o"] = "f11a";
		fontAwesome["fa-microphone"] = "f130";
		fontAwesome["fa-microphone-slash"] = "f131";
		fontAwesome["fa-minus"] = "f068";
		fontAwesome["fa-minus-circle"] = "f056";
		fontAwesome["fa-minus-square"] = "f146";
		fontAwesome["fa-minus-square-o"] = "f147";
		fontAwesome["fa-mobile"] = "f10b";
		fontAwesome["fa-money"] = "f0d6";
		fontAwesome["fa-moon-o"] = "f186";
		fontAwesome["fa-music"] = "f001";
		fontAwesome["fa-newspaper-o"] = "f1ea";
		fontAwesome["fa-openid"] = "f19b";
		fontAwesome["fa-outdent"] = "f03b";
		fontAwesome["fa-pagelines"] = "f18c";
		fontAwesome["fa-paint-brush"] = "f1fc";
		fontAwesome["fa-paper-plane"] = "f1d8";
		fontAwesome["fa-paper-plane-o"] = "f1d9";
		fontAwesome["fa-paperclip"] = "f0c6";
		fontAwesome["fa-paragraph"] = "f1dd";
		fontAwesome["fa-pause"] = "f04c";
		fontAwesome["fa-paw"] = "f1b0";
		fontAwesome["fa-paypal"] = "f1ed";
		fontAwesome["fa-pencil"] = "f040";
		fontAwesome["fa-pencil-square"] = "f14b";
		fontAwesome["fa-pencil-square-o"] = "f044";
		fontAwesome["fa-phone"] = "f095";
		fontAwesome["fa-phone-square"] = "f098";
		fontAwesome["fa-picture-o"] = "f03e";
		fontAwesome["fa-pie-chart"] = "f200";
		fontAwesome["fa-pied-piper"] = "f1a7";
		fontAwesome["fa-pied-piper-alt"] = "f1a8";
		fontAwesome["fa-pinterest"] = "f0d2";
		fontAwesome["fa-pinterest-square"] = "f0d3";
		fontAwesome["fa-plane"] = "f072";
		fontAwesome["fa-play"] = "f04b";
		fontAwesome["fa-play-circle"] = "f144";
		fontAwesome["fa-play-circle-o"] = "f01d";
		fontAwesome["fa-plug"] = "f1e6";
		fontAwesome["fa-plus"] = "f067";
		fontAwesome["fa-plus-circle"] = "f055";
		fontAwesome["fa-plus-square"] = "f0fe";
		fontAwesome["fa-plus-square-o"] = "f196";
		fontAwesome["fa-power-off"] = "f011";
		fontAwesome["fa-print"] = "f02f";
		fontAwesome["fa-puzzle-piece"] = "f12e";
		fontAwesome["fa-qq"] = "f1d6";
		fontAwesome["fa-qrcode"] = "f029";
		fontAwesome["fa-question"] ="f128";
		fontAwesome["fa-question-circle"] = "f059";
		fontAwesome["fa-quote-left"] = "f10d";
		fontAwesome["fa-quote-right"] = "f10e";
		fontAwesome["fa-random"] = "f074";
		fontAwesome["fa-rebel"] = "f1d0";
		fontAwesome["fa-recycle"] = "f1b8";
		fontAwesome["fa-reddit"] = "f1a1";
		fontAwesome["fa-reddit-square"] = "f1a2";
		fontAwesome["fa-refresh"] = "f021";
		fontAwesome["fa-renren"] = "f18b";
		fontAwesome["fa-repeat"] = "f01e";
		fontAwesome["fa-reply"] = "f112";
		fontAwesome["fa-reply-all"] = "f122";
		fontAwesome["fa-retweet"] = "f079";
		fontAwesome["fa-road"] = "f018";
		fontAwesome["fa-rocket"] = "f135";
		fontAwesome["fa-rss"] = "f09e";
		fontAwesome["fa-rss-square"] = "f143";
		fontAwesome["fa-rub"] = "f158";
		fontAwesome["fa-scissors"] = "f0c4";
		fontAwesome["fa-search"] = "f002";
		fontAwesome["fa-search-minus"] = "f010";
		fontAwesome["fa-search-plus"] = "f00e";
		fontAwesome["fa-share"] = "f064";
		fontAwesome["fa-share-alt"] = "f1e0";
		fontAwesome["fa-share-alt-square"] = "f1e1";
		fontAwesome["fa-share-square"] = "f14d";
		fontAwesome["fa-share-square-o"] = "f045";
		fontAwesome["fa-shield"] = "f132";
		fontAwesome["fa-shopping-cart"] = "f07a";
		fontAwesome["fa-sign-in"] = "f090";
		fontAwesome["fa-sign-out"] = "f08b";
		fontAwesome["fa-signal"] = "f012";
		fontAwesome["fa-sitemap"] = "f0e8";
		fontAwesome["fa-skype"] = "f17e";
		fontAwesome["fa-slack"] = "f198";
		fontAwesome["fa-sliders"] = "f1de";
		fontAwesome["fa-slideshare"] = "f1e7";
		fontAwesome["fa-smile-o"] = "f118";
		fontAwesome["fa-sort"] = "f0dc";
		fontAwesome["fa-sort-alpha-asc"] = "f15d";
		fontAwesome["fa-sort-alpha-desc"] = "f15e";
		fontAwesome["fa-sort-amount-asc"] = "f160";
		fontAwesome["fa-sort-amount-desc"] = "f161";
		fontAwesome["fa-sort-asc"] = "f0de";
		fontAwesome["fa-sort-desc"] = "f0dd";
		fontAwesome["fa-sort-numeric-asc"] = "f162";
		fontAwesome["fa-sort-numeric-desc"] = "f163";
		fontAwesome["fa-soundcloud"] = "f1be";
		fontAwesome["fa-space-shuttle"] = "f197";
		fontAwesome["fa-spinner"] = "f110";
		fontAwesome["fa-spoon"] = "f1b1";
		fontAwesome["fa-spotify"] = "f1bc";
		fontAwesome["fa-square"] = "f0c8";
		fontAwesome["fa-square-o"] = "f096";
		fontAwesome["fa-stack-exchange"] = "f18d";
		fontAwesome["fa-stack-overflow"] = "f16c";
		fontAwesome["fa-star"] = "f005";
		fontAwesome["fa-star-half"] = "f089";
		fontAwesome["fa-star-half-o"] = "f123";
		fontAwesome["fa-star-o"] = "f006";
		fontAwesome["fa-steam"] = "f1b6";
		fontAwesome["fa-steam-square"] = "f1b7";
		fontAwesome["fa-step-backward"] = "f048";
		fontAwesome["fa-step-forward"] = "f051";
		fontAwesome["fa-stethoscope"] = "f0f1";
		fontAwesome["fa-stop"] = "f04d";
		fontAwesome["fa-strikethrough"] = "f0cc";
		fontAwesome["fa-stumbleupon"] = "f1a4";
		fontAwesome["fa-stumbleupon-circle"] = "f1a3";
		fontAwesome["fa-subscript"] = "f12c";
		fontAwesome["fa-suitcase"] = "f0f2";
		fontAwesome["fa-sun-o"] = "f185";
		fontAwesome["fa-superscript"] = "f12b";
		fontAwesome["fa-table"] = "f0ce";
		fontAwesome["fa-tablet"] = "f10a";
		fontAwesome["fa-tachometer"] = "f0e4";
		fontAwesome["fa-tag"] = "f02b";
		fontAwesome["fa-tags"] = "f02c";
		fontAwesome["fa-tasks"] = "f0ae";
		fontAwesome["fa-taxi"] ="f1ba";
		fontAwesome["fa-tencent-weibo"] = "f1d5";
		fontAwesome["fa-terminal"] = "f120";
		fontAwesome["fa-text-height"] = "f034";
		fontAwesome["fa-text-width"] = "f035";
		fontAwesome["fa-th"] = "f00a";
		fontAwesome["fa-th-large"] = "f009";
		fontAwesome["fa-th-list"] = "f00b";
		fontAwesome["fa-thumb-tack"] = "f08d";
		fontAwesome["fa-thumbs-down"] = "f165";
		fontAwesome["fa-thumbs-o-down"] = "f088";
		fontAwesome["fa-thumbs-o-up"] = "f087";
		fontAwesome["fa-thumbs-up"] = "f164";
		fontAwesome["fa-ticket"] = "f145";
		fontAwesome["fa-times"] = "f00d";
		fontAwesome["fa-times-circle"] = "f057";
		fontAwesome["fa-times-circle-o"] = "f05c";
		fontAwesome["fa-tint"] = "f043";
		fontAwesome["fa-toggle-off"] = "f204";
		fontAwesome["fa-toggle-on"] = "f205";
		fontAwesome["fa-trash"] = "f1f8";
		fontAwesome["fa-trash-o"] = "f014";
		fontAwesome["fa-tree"] = "f1bb";
		fontAwesome["fa-trello"] = "f181";
		fontAwesome["fa-trophy"] = "f091";
		fontAwesome["fa-truck"] = "f0d1";
		fontAwesome["fa-try"] = "f195";
		fontAwesome["fa-tty"] = "f1e4";
		fontAwesome["fa-tumblr"] = "f173";
		fontAwesome["fa-tumblr-square"] = "f174";
		fontAwesome["fa-twitch"] = "f1e8";
		fontAwesome["fa-twitter"] = "f099";
		fontAwesome["fa-twitter-square"] = "f081";
		fontAwesome["fa-umbrella"] = "f0e9";
		fontAwesome["fa-underline"] = "f0cd";
		fontAwesome["fa-undo"] = "f0e2";
		fontAwesome["fa-university"] = "f19c";
		fontAwesome["fa-unlock"] = "f09c";
		fontAwesome["fa-unlock-alt"] = "f13e";
		fontAwesome["fa-upload"] = "f093";
		fontAwesome["fa-usd"] = "f155";
		fontAwesome["fa-user"] = "f007";
		fontAwesome["fa-user-md"] = "f0f0";
		fontAwesome["fa-users"] = "f0c0";
		fontAwesome["fa-video-camera"] = "f03d";
		fontAwesome["fa-vimeo-square"] = "f194";
		fontAwesome["fa-vine"] = "f1ca";
		fontAwesome["fa-vk"] = "f189";
		fontAwesome["fa-volume-down"] = "f027";
		fontAwesome["fa-volume-off"] = "f026";
		fontAwesome["fa-volume-up"] = "f028";
		fontAwesome["fa-weibo"] = "f18a";
		fontAwesome["fa-weixin"] = "f1d7";
		fontAwesome["fa-wheelchair"] = "f193";
		fontAwesome["fa-wifi"] = "f1eb";
		fontAwesome["fa-windows"] = "f17a";
		fontAwesome["fa-wordpress"] = "f19a";
		fontAwesome["fa-wrench"] = "f0ad";
		fontAwesome["fa-xing"] = "f168";
		fontAwesome["fa-xing-square"] = "f169";
		fontAwesome["fa-yahoo"] = "f19e";
		fontAwesome["fa-yelp"] = "f1e9";
		fontAwesome["fa-youtube"] = "f167";
		fontAwesome["fa-youtube-play"] = "f16a";
		fontAwesome["fa-youtube-square"] = "f166";
    console.log(fontAwesome);
    let =htmls="<option value=''>--select--</option>"
    for(var i in fontAwesome){
      htmls+="<option value='"+i+'|'+fontAwesome[i]+"'>&#x"+fontAwesome[i]+"; "+i+"</option>";
    }
    // fontAwesome.forEach(function(val,key){
    //   console.log(val)
    //   htmls+="<option value='"+key+'|'+val+"'>&#x"+val+"</option>";
    // })
	$('form select').niceSelect('destroy');
	$('form select').html(htmls);
    $('form select').niceSelect('update');
	
</script>