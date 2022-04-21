                       <?php $i = 0; $status=1?>
                       @if(count($partners)!=0 && $partners )
                        @foreach($partners as $partner)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                                                        
                            <td><img src="{{$partner->getFirstMediaUrl('partner','index')}}"></td>
                            <td>{{$partner->name_ar}}</td>
                            <td><?php if($partner->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td>{{$partner->sort}}</td>

                            <td>
                                <a href="{{url('partner/'.encrypt($partner ->id).'/edit/')}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                                /
                                <a href="#"  style="font-weight: bold;font-size: 17px;" title="حذف" data-catid="{{$partner->id}}" data-toggle="modal" data-target="#delete{{$partner->id}}"> <i class="fa fa-trash red"></i></a>
							  <!--############################ model for delete #################################-->     
                              <div class="modal modal-danger fade" id="delete{{$partner->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('partner.destroy',encrypt($partner->id))}}"  method="post">
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
                            </div>
            <!--#############################################################-->
                            </td>
                            <td><input type="checkbox" name="row_checkbox" value="{{$partner->id}}" class="box1" onclick="javascript:check();"></td>

                        </tr>

                       

                        @endforeach

                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $partners->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $partners->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif