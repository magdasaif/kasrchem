                       <?php $i = 0; $status=1?>
                       @if(count($releases)!=0 && $releases )
                       @foreach($releases as $release)
                            <tr>
                            <?php $i++; ?>
                            <td> {{$i}}</td>
                            <td><img src="{{$release->getFirstMediaUrl('releases','index')}}"></td>                              

                             <td>{{$release->name_ar}}</td>
                             <td><?php if($release->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                             <td>{{$release->sort}}</td>
                            <td>
                                <a href="{{route('release.edit',encrypt($release->id))}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                                /
                                <a href="#" style="font-weight: bold;font-size: 17px;" title="حذف" data-catid="{{$release->id}}" data-toggle="modal" data-target="#delete{{$release->id}}"> <i class="fa fa-trash red"></i></a>
						  <!--############################ model for delete #################################-->
          
                          <div class="modal modal-danger fade" id="delete{{$release->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('release.destroy',encrypt($release->id))}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                             <div   style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$release->name_ar}}</div>
                                            <input type="hidden" name="release_id" id="$release->id" value="$release->id">

                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$release->image}}">
                                    <input type="hidden" name="deleted_file" value="{{$release->file}}">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-success">حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
                            </td>
                            <td><input type="checkbox" name="row_checkbox" value="{{$release->id}}" class="box1" onclick="javascript:check();"></td>

                            </tr>
                      

                        @endforeach

                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $releases->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $releases->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif