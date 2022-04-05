
   <a href="{{url('partner/'.$partner ->id.'/edit/')}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>    تعديل
    </a>
    /
    <a href="#"  style="font-weight: bold;font-size: 17px;" title="حذف" data-catid="{{$partner->id}}" data-toggle="modal" data-target="#delete{{$partner->id}}"> <i class="fa fa-trash red"></i></a>
    <!--############################ model for delete #################################-->     
    <div class="modal modal-danger fade" id="delete{{$partner->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card-header" >
                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                </div>
                <form action="{{route('partner.destroy',$partner->id)}}"  method="post">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                    <div class="modal-body">
                            <h3 class="text-center">
                                هل تريد الحذف بالفعل؟
                                </h3>
                                <div   style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$partner->name_ar}}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                        <input type="submit" value="حذف"  class="btn btn-primary">
                    </div>
                </form>
        </div>
    </div>

   <!--========================================================-->
 <?php $type="partner";?>
  @include('delete_all_model')
    <!--========================================================-->  