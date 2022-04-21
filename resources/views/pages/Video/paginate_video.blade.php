                       <?php $i = 0; $status=1?>
                       @if(count($videos)!=0 && $videos )
                        @foreach($videos as $video)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td>{{$video->name_ar}}</td>
                            <td><?php if($video->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td>{{$video->sort}}</td>

                            <td style="display: inline-flex;">
                                <a href="{{route('video.edit',encrypt($video->id))}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                                 
                                &nbsp; / &nbsp;
                                <a  title="حذف" data-catid="{$video->id}}" data-toggle="modal" data-target="#delete{{$video->id}}"> <i class="fa fa-trash red del"></i></a> 

                                 <!--############################ model for delete #################################-->
          
                            <div class="modal modal-danger fade" id="delete{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form class="delete" action="{{ route('video.destroy',encrypt($video->id)) }}" method="POST">
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
                   <td ><input  type="checkbox"  name="row_checkbox" value="{{$video->id}}" class="box1" onclick="javascript:check();"></td>
       
                            </tr>
                        
                        @endforeach
                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $videos->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $videos->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif