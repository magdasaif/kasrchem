@extends('layouts.master')
@section('css')
@livewireStyles
@section('title')
    اضافه منتج
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الصفحه الرئيسيه</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                 <livewire:productlivewire />
                 
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    @livewireScripts


    <script>

document.addEventListener('livewire:load', function () {
        // function show_sub2(){
        //    alert('dddd');
        //    document.getElementById('sub2_div').style.display='block';
        // }

          //  $("#all").css('display', 'none'); 
        //---------------for show seelct option of sub2------------------------//
        $(document).ready(function () {
            $('select[name="main_cate_id"]').on('change', function () {                
                var main_cate_id = $(this).val();
               if (main_cate_id) {
                   alert(main_cate_id);
                  //alert("{{ URL::to('fetch_sub2')}}/" + main_cate_id);
                   
                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('fetch_sub2')}}/" + main_cate_id,
                        dataType: "json",
                        success: function (data) 
                        {
                           //  alert(data);

                              $("#all").show();

                            //   $("#sub2_div").show();
                            //  $('#sub2_id').empty();
                            //  $('#sub2_id').append('<option value="0" disabled="true" selected="true">اختر التصنيف الفرعي</option>');
                            //  $.each(data, function (key, value) {
                            //      //alert('<option value="' + key + '">' + value + '</option>');
                            //   $('#sub2_id').append('<option value="' + key + '">' + value + '</option>');
                            //  });
                         
                        },
                        error:function()
                        { alert("false"); }
                    });
                   
                }
                else {
                    alert('AJAX load did not work');
                }
            });
        });
    });    
        //--------------------------------------------------------------------------//
    </script>
@endsection
