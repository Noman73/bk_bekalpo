<script>

$(function() {
  $('.item-img-gallery .tab-pane img').watermark({
    // text: 'bekalpo.com',
    // textSize:30,
    // textWidth: 200,
    // gravity: 'Southwest',
    // opacity: 1,
    // margin: 12
    path:"{{asset('storage/logo/'.(App\Models\Company::first()->logo))}}"
  });
});
</script>