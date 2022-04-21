                       <?php $i = 0; $status=1?>
                       @if(count($branches)!=0 && $branches )
                        @foreach($branches as $branche)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$branche->name_ar}}</td>
                            @if($branche->phone=='')<td><span style="color: red;">لا يوجد رقم للهاتف</span></td> 
                             @else
                             <td>{{$branche->phone}}</td>
                             @endif
                            @if($branche->email=='') <td><span style="color: red;">لا يوجد ميل</span></td> 
                            @else
                            <td>{{$branche->email}}</td>
                           @endif
                           
                            <td><?php if($branche->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td>{{$branche->sort}}</td>
                            <td>
                                <a href="{{url('branches/'.encrypt($branche ->id).'/edit/')}}"  title="تعديل" style="font-weight: bold;font-size: 17px;"><i class="fa fa-edit blue"></i></a>
                                /
                                <a href="#" style="font-weight: bold;font-size: 17px;" title="حذف" data-catid="{{$branche->id}}" data-toggle="modal" data-target="#delete{{$branche->id}}"> <i class="fa fa-trash red"></i></a>
						 <!--############################ model for delete #################################-->     
                         <div class="modal modal-danger fade" id="delete{{$branche->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header">
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('branches.destroy',encrypt($branche ->id))}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                             <div   style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$branche->name_ar}}</div>
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
                            <td><input type="checkbox" name="row_checkbox" value="{{$branche->id}}" class="box1" onclick="javascript:check();"></td>

                        </tr>

                        

                        @endforeach
                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $branches->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $branches->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif