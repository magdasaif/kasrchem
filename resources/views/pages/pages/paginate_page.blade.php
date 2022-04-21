                       <?php $i = 0; $status=1?>
                       @if(count($Page)!=0 && $Page )
                       @foreach($Page as $Pagee)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td>{{$Pagee->name_ar}}</td>
							<td style="font-weight: bold;font-size: 17px;"><?php if($Pagee->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td>{{$Pagee->sort}}</td>
							<td style="font-weight: bold;font-size: 17px;">
							<a href="{{route('page.edit',encrypt($Pagee->id))}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
							/
                            <a href="{{ url('page_img/'.encrypt($Pagee->id)) }}"><i class="fa fa-camera yellow"></i></a>
                            /
					        <a  title="حذف" data-catid="{{$Pagee->id}}" data-toggle="modal" data-target="#delete{{$Pagee->id}}"> <i class="fa fa-trash red"></i></a>
                            <!--############################ model for delete #################################-->
                                
                            <div class="modal modal-danger fade" id="delete{{$Pagee->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="card-header" >
                                        <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                    </div>
                                    <form action="{{route('page.destroy',encrypt($Pagee->id))}}"  method="post">
                                            {{method_field('delete')}}
                                            {{csrf_field()}}
                                        <div class="modal-body">
                                                <h3 class="text-center">
                                                    هل تريد الحذف بالفعل؟
                                                </h3>
                                                <input type="hidden" name="Page_id" id="$Pagee->id" value="{{$Pagee->id}}">
                                                <div  name="Page_title_ar" style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$Pagee->name_ar}}</div>
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
                             <!-- <button class="btn btn-danger" data-catid={{$Pagee->id}} data-toggle="modal" data-target="#delete{{$Pagee->id}}">حذف</button> -->
							 
                            </td>
                            <td><input type="checkbox" name="row_checkbox" value="{{$Pagee->id}}" class="box1" onclick="javascript:check();"></td>

                            </tr>
                     

                        @endforeach

                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $Page->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $Page->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif