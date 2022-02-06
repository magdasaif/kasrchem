@extends('layouts.master')
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
              <div class="card-header" >
                <h3 class="card-title">  {{$title}}</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm" style=" background-color: #343a40;">
                        <a href="{{route('social.create')}}" style="color: #fff; !important"> <li class="fa fa-plus-square" ><span> اضافة  </span></li></a>
                        </button>
                        

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
            <!--#############################################################-->
                    <thead>
                        <tr >
                            <th>#</th>
                            <th>اسم الرابط</th>
                            <th> الايقون</th>
                            <th>الحاله</th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($socialLinks as $social)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$social->name}}</td>
                            <td><li class="{{$social->icon}}"></li></td>

                            <td><?php if($social->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            
                            <td>
                                <a href="{{url('social/'.$social ->id.'/edit/')}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                                /
                                <a href="#"  title="حذف" data-catid="{{$social->id}}" data-toggle="modal" data-target="#delete{{$social->id}}"> <i class="fa fa-trash red"></i></a>
                            </td>
                            
                        </tr>

                         <!--############################ model for delete #################################-->     
                         <div class="modal modal-danger fade" id="delete{{$social->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('social.destroy',$social->id)}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-success">حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->

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