@extends('layouts.master')
@section('title')
<title>لوحة التحكم :  {{$title}}</title>

 @endsection
@section('content')
<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

        <div class="col-12">
                <!----------------start success ___ error----------------->
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
           @endif
      <!------------------end success ___ error----------------->

             @if(Session::has('msg'))
             <center>
               <div class="alert alert-danger" style="font-size: 15px; color: #009879; font-weight: bold; background-color: rgb(243, 243, 243);width: fit-content;border-color: #009879;">
            
              <!--------if section relate with child section----------->
             
             {{-- @if (Session::get('type')=='related_section') --}}
             @if (Session::get('data')&& sizeof(Session::get('data'))!=0)
             {{Session::get('msg')}}
             <ol> 
                @foreach(session::get('data')  as $child_sections)
                 <a href={{route('site_section.edit',encrypt($child_sections->id))}} target="_blank"><li style="color: #e3342f;">{{$child_sections->name_ar}}</li></a>
                @endforeach
              </ol> 
             @endif


             {{-- @if (Session::get('type')=='video') --}}
             @if (Session::get('data_video')&& sizeof(Session::get('data_video'))!=0)          
                {{Session::get('msg_video')}}
             <ol> 
                @foreach(session::get('data_video')  as $child_sections)
                 <a href={{route('video.edit',encrypt($child_sections->id))}} target="_blank"><li style="color: #e3342f;">{{$child_sections->name_ar}}</li></a>
                @endforeach
             </ol>
             @endif

             {{-- @if (Session::get('type')=='article') --}}
             @if (Session::get('data_article')&& sizeof(Session::get('data_article'))!=0)  
             {{Session::get('msg_article')}}
             <ol> 
                @foreach(session::get('data_article')  as $child_sections)
                   <a href={{route('article.edit',encrypt($child_sections->id))}} target="_blank"><li style="color: #e3342f;">{{$child_sections->name_ar}}</li></a>
                @endforeach
             </ol>
             @endif


             {{-- @if (Session::get('type')=='photo_gallery') --}}
             @if (Session::get('data_photo_gallery')&& sizeof(Session::get('data_photo_gallery'))!=0)  
             {{Session::get('msg_photo_gallery')}}
             <ol> 
                @foreach(session::get('data_photo_gallery')  as $child_sections)
                  <a href={{route('photo_gallery.edit',encrypt($child_sections->id))}} target="_blank"><li style="color: #e3342f;">{{$child_sections->name_ar}}</li></a>
                @endforeach
             </ol>
             @endif
            

             @if (Session::get('data_release')&& sizeof(Session::get('data_release'))!=0)  
             {{Session::get('msg_release')}}
             <ol> 
                @foreach(session::get('data_release')  as $child_sections)
                  <a href={{route('release.edit',encrypt($child_sections->id))}} target="_blank"><li style="color: #e3342f;">{{$child_sections->name_ar}}</li></a>
                @endforeach
             </ol>
             @endif


              <!-------------------------------------------------------------------->
             {{Session::get('msg2')}}
            </div>
           </center>
            @endif

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn">
                        <a href="{{URL('site_section/create')}}" class="aa"> <li class="fa fa-plus-square" ><span>اضافة قسم جديد</span></li></a>
                        </button>
                        

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                    <!--=======================searchand form ============================-->
       
            <div class="col-md-6" style="margin-top:40px">
                 <div class="form-group" style="border: 3px solid;color: azure;">
                    <!-- <input type="text" class="form-control" name="query_text"     onkeyup="search_func(this.value);" placeholder=" بحث باسم القسم ....."   value="{{ request()->input('query_text') }}"> -->
                    <input type="text" class="form-control" name="query_text"   id="serach"   placeholder=" بحث باسم القسم ....."   value="{{ request()->input('query_text') }}">
                 </div>
            </div>
              <br>  
          <!--===========================================================================-->
                <table class="table table-hover styled-table">
                  <thead>
                    <tr>
                      <th>#</th>
                        <th>اسم القسم</th>
                        <th>الصورة</th>
                        <th>الأولوية</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                    </tr>
                  </thead>
                  
                   <tbody>
                        
                 
                   @include('pages.Sitesection.pagination_data')
   
                    </tbody>
                </table>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

               
              </div>
          </div>
        </div>
        </div>

  </section>
</template>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

 <script type="text/javascript">
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
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
$(document).ready(function(){

 function fetch_data(page,query)
 {
  $.ajax({
    //Route::get('/pagination/fetch_data', 'PaginationController@fetch_data');
   url:"/Sitesection/fetch_data?page="+page+"&query="+query,
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

    fetch_data(page,query);

 });

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  
  var query = $('#serach').val();

  $('li').removeClass('active');
        $(this).parent().addClass('active');
  fetch_data(page, query);
 });

});

</script>

@endsection

