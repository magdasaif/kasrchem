                       <?php $i = 0; $status=1?>
                       @if(count($Photo_Gal)!=0 && $Photo_Gal )
                       @foreach($Photo_Gal as $Photo_Gallery)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td><img src="{{$Photo_Gallery->getFirstMediaUrl('gallery','index')}}"></td>
                            <td>{{$Photo_Gallery->name_ar}}</td>
                            <td>{{$Photo_Gallery->sort}}</td>
                            <td><?php if($Photo_Gallery->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td style="font-weight: bold;font-size: 17px;"> 
                             <a href="{{route('photo_gallery.edit',encrypt($Photo_Gallery->id))}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                             /
                             <a href="{{ url('show_gallery_images/'.encrypt($Photo_Gallery->id)) }}"  title="الصور"><i class="fa fa-camera yellow"></i></a>

                              /
                              <a  title="حذف" data-catid="{{$Photo_Gallery->id}}" data-toggle="modal" data-target="#delete{{$Photo_Gallery->id}}"> <i class="fa fa-trash red"></i></a>
                             
                         <!--############################ model for delete #################################-->
          
                         <div class="modal modal-danger fade" id="delete{{$Photo_Gallery->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('photo_gallery.destroy',encrypt($Photo_Gallery->id))}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                            <input type="hidden" name="galary_id" id="$Photo_Gallery->id" value="{{$Photo_Gallery->id}}">
                                            <img  style="width: 90px; height: 90px;" src="{{$Photo_Gallery->getFirstMediaUrl('gallery','index')}}" alt="" >
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
                        <td><input type="checkbox" name="row_checkbox"  value="{{$Photo_Gallery->id}}" class="box1" onclick="javascript:check();"></td>

                            </tr>
                        

                        @endforeach
                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $Photo_Gal->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $Photo_Gal->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif