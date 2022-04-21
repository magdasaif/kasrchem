
$(document).ready(function(){
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
function fetch_data(page,query,blade_url,blade_model)
{
//alert(blade_url);
//alert(blade_model);
$.ajax({
//Route::get('/pagination/fetch_data', 'PaginationController@fetch_data');
//url:"/Sitesection/fetch_data?page="+page+"&query="+query,
//url:"/"+blade_url+"/fetch_data?page="+page+"&query="+query,
url:"/"+blade_url+"/fetch_data/"+blade_model+"?page="+page+"&query="+query,
success:function(data)
{
//alert(data);
//*******PUT DATA IN BODY OF TABLE*******
$('tbody').html('');
$('tbody').html(data);
}
})
}

$(document).on('keyup', '#serach', function(){
var query = $('#serach').val();
var page = $('#hidden_page').val();
var blade_url = $('#hidden_blade').val();
var blade_model = $('#hidden_model').val();
fetch_data(page,query,blade_url,blade_model);

});

$(document).on('click', '.pagination a', function(event){
event.preventDefault();
var page = $(this).attr('href').split('page=')[1];
$('#hidden_page').val(page);

var query = $('#serach').val();
var blade_url = $('#hidden_blade').val();
var blade_model = $('#hidden_model').val();
$('li').removeClass('active');
    $(this).parent().addClass('active');
    fetch_data(page,query,blade_url,blade_model);

});

});

/*******************************************************
 function search_func(query_text)
{
  $.ajax({
    type : 'get',

  url : '{{URL::to('search_section')}}',
    data:{'query_text':query_text},

   // var llink = APP_URL+"/search_section/"+query_text;
    // url: llink,
   // data:{'query_text':query_text},
    success:function(data)
    {
   // alert(data);
     $('tbody').html('');
   $('tbody').html(data);
    }
  });

}
********************************************************/