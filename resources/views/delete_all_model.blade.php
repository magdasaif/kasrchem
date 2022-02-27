 <!-- this form for delete more than classes -->


    <div class="modal modal-danger fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="direction: ltr;">
            <div class="card-header" >
                <h4 class="modal-title " id="myModalLabel">تاكيد الحذف للمُحدد</h4>
            </div>
            <form class="delete" action="{{route('delete_all_'.$type)}}" method="POST">
            @method('POST')
            {{csrf_field()}}
                <div class="modal-body">
                        <center><h3 class="text-center" style="margin-right: -127px;">
                        هل تريد بالفعل حذف كل البيانات المُحدده ؟
                            </h3><center>
                </div>
                <div class="modal-footer">
                <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>

                <center>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                    <input type="submit" value="حذف"  class="btn btn-primary">
                </center>
                </div>
            </form>
            </div>
        </div>
    </div>