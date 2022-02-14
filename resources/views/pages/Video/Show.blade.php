@extends('layouts.master')
@section('title')
<title>لوحة التحكم : الفيديوهات</title>
 @endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
        <div class="row">

        <div class="col-12">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif
          
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">  الفيديوهات</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn">
                        <a href="{{route('video.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة فيديو </span></li></a>
                        </button>
                        

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover styled-table">
            <!--#############################################################-->
                    <thead>
                        <tr  style="color: #17899b;" >
                        <th>#</th>
                        <th>عنوان الفيديو</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0; $status=1?>
                        @foreach($Vid as $video)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td>{{$video->title_ar}}</td>
                            <td><?php if($video->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                           

                            <td style="display: inline-flex;">
                                <a href="{{route('video.edit',$video->id)}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                                 
                                &nbsp; / &nbsp;
                                <a  title="حذف" data-catid="{$video->id}}" data-toggle="modal" data-target="#delete{{$video->id}}"> <i class="fa fa-trash red del"></i></a> 

                                 <!--############################ model for delete #################################-->
          
                            <div class="modal modal-danger fade" id="delete{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form class="delete" action="{{ route('video.destroy',$video->id) }}" method="POST">
                                <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                       </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="_method" value="DELETE">
                                       <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                      <input type="submit" value="حذف"  class="btn btn-primary">
                                    </div>
                                   

                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
                   </td>
                            
                            </tr>
                        
                        @endforeach

                    </tbody>

            <!--#############################################################-->

		</table>
            </div>
          
          </div>
        </div>
        </div>
  </section>
@endsection
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script >
    // $(".delete").on("submit", function(){


    //     if(!confirm(" هل تريد الحذف بالفعل؟"))
    //     event.preventDefault();
    //     return confirm(" هل تريد الحذف بالفعل؟");
    // });

 
</script>