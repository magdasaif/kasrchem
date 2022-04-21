                       <?php $i = 0; $status=1?>
                       @if(count($socialLinks)!=0 && $socialLinks )
                       @foreach($socialLinks as $social)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$social->name}}</td>
                            <td ><li class="{{$social->icon}} "></li></td>

                            <td><?php if($social->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            
                            <td>
                                <a href="{{url('social/'.encrypt($social ->id).'/edit/')}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                                /
                                <a href="#" style="font-weight: bold;font-size: 17px;" title="حذف" data-catid="{{$social ->id}}" data-toggle="modal" data-target="#delete{{$social ->id}}"> <i class="fa fa-trash red"></i></a>
                              <!--############################ model for delete #################################-->     
                         <div class="modal modal-danger fade" id="delete{{$social ->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('social.destroy',encrypt($social ->id))}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                             <div   style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$social->name}}</div>
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
                            <td ><input type="checkbox"  name="row_checkbox" value="{{$social->id}}" class="box1" onclick="javascript:check();"></td>

                        </tr>

                       

                        @endforeach

                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $socialLinks->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $socialLinks->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif