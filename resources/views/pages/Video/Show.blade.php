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
                        <a href="{{route('video.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة  </span></li></a>
                        </button>
                        <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>


                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table id="datatable" class="table table-hover styled-table">
            <!--#############################################################-->
                    <thead>
                        <tr  style="color: #17899b;" >
                        <th>#</th>
                        <th>عنوان الفيديو</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        <th ><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>
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
                                             <div   style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$video->link}}</div>
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
                   <td ><input type="checkbox" value="{{$video->id}}" class="box1" onclick="javascript:check();"></td>
       
                            </tr>
                        
                        @endforeach

                    </tbody>

            <!--#############################################################-->

		</table>
            </div>
          
          </div>
           <!--========================================================-->
  <?php $type="video";?>
  @include('delete_all_model')
  <!--========================================================-->
        </div>
        </div>
  </section>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>

@endsection