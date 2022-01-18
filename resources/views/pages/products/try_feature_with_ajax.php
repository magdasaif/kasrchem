 <!-------------------------------------------------------------------------->
 <? $i=0;?>
              <label for="exampleInputEmail1">اضافه خصائص المنتج</label>
              <div id="features">
                <div class=" add-input">
                    <div class="row" >
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="الخاصيه مثال : الوزن" name="weight_ar.0">
                                @error('weight_ar.0') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" name="value_ar.0" placeholder="القيمة (مثال : 10كجم)"/>
                            @error('value_ar.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="col">
                            <input class="form-control" type="text" name="weight_en.0" placeholder="الخاصية بالانجليزية (مثال : weight)"/>
                            @error('weight_en.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="col">
                            <input class="form-control" type="text" name="value_en.0" placeholder="القيمة بالانجليزيه (مثال : 10كجم)"/>
                            @error('value_en.0') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="col-md-2">
                            <input type="hidden" name="increment" id ="increment" value="{{$i}}">
                            <button type="button" class="btn text-white btn-info btn-sm" name="add_feature" id="add_feature">اضافه</button>
                            <!-- <a href="{{url('add/'.$i)}}">اضافه</a> -->
                        </div>
                    </div>
                </div>
</div>
                @foreach($inputs as $key => $value)
                    <div class=" add-input" >
                        <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="الخاصيه مثال : الوزن" name="weight_ar.{{$value}}">
                                @error('weight_ar.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" name="value_ar.{{$value}}" placeholder="القيمة (مثال : 10كجم)"/>
                            @error('value_ar.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="col">
                            <input class="form-control" type="text" name="weight_en.{{$value}}" placeholder="الخاصية بالانجليزية (مثال : weight)"/>
                            @error('weight_en.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="col">
                            <input class="form-control" type="text" name="value_en.{{$value}}" placeholder="القيمة بالانجليزيه (مثال : 10كجم)"/>
                            @error('value_en.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger btn-sm"> <a href="{{url('remove/'.$key)}}">حذف</a></button>
                            </div>
                        </div>
                    </div>
                @endforeach
        
                <!-------------------------------------------------------------------------->


                //---------------add_feature------------------------//
        // $(document).ready(function () {
        //     $('#add_feature').on('click', function () {
        //         var increment = $('#increment').val();
        //        // alert (increment);
        //        if (increment) {
        //          //  alert("{{ URL::to('add')}}/" + increment);
                   
        //             $.ajax({
        //                 type: "GET",
        //                 url: "{{ URL::to('add')}}/" + increment,
        //                 dataType: "json",
                      
        //                 success: function (data) 
        //                 {
        //                     // alert("true");
        //                      $.each(data, function (key, value) {
        //                        // alert(key);
        //                         //alert(value);
        //                         var increment = parseInt($("#increment").val());
        //                         increment++;
        //                         $('#increment').val(increment);
        //                         $('#features').append('<div class=" add-input"><div class="row"><div class="col"><div class="form-group"><input type="text" class="form-control"  name="weight_ar.'+value+'"> @error("weight_ar.'+value+'") <span class="text-danger error">{{ $message }}</span>@enderror</div></div> <div class="col"><input class="form-control" type="text" name="value_ar.'+value+'" placeholder="القيمة (مثال : 10كجم)"/>@error("value_ar.'+value+'") <span class="text-danger error">{{ $message }}</span>@enderror</div><div class="col"><input class="form-control" type="text" name="weight_en.'+value+'" placeholder="القيمة (مثال : 10كجم)"/>@error("weight_en.'+value+'") <span class="text-danger error">{{ $message }}</span>@enderror</div><div class="col"><input class="form-control" type="text" name="value_en.'+value+'" placeholder="القيمة (مثال : 10كجم)"/>@error("value_en.'+value+'") <span class="text-danger error">{{ $message }}</span>@enderror</div>  <div class="col-md-2"><button class="btn btn-danger btn-sm" onclick="remove_div('+value+')"> حذف</button></div></div></div>');

        //                      });                      
        //                 },
        //                 error:function()
        //                 { alert("false"); }
        //             });
                   
        //         }
        //         else {
        //             alert('AJAX load did not work');
        //         }
        //     });
        // });

        // function remove_div(value){}
        //--------------------------------------------------------------------------//


        public $inputs;
    public $i;


    public function __construct()
    {
        $this->inputs = array();
        $this->i=0;
    }
    
    protected $rules = [
        //exists:main_categories,id
        'main_cate_id' => 'required',
        'sub2' => 'required',
        'sub3' => 'required',
        'sub4' => 'required',
        'code'=>'required|unique:products',
        'name_ar'=>'required|unique:products',
        'name_en'=>'required|unique:products',
        'price'=>'required',
        'desc_ar'=>'required',
        'desc_en'=>'required',
        'amount'=>'required',
        'amount'=>'required|integer',
        'min_amount'=>'required|integer',
        'max_amount'=>'required|integer',
        'sort'=>'integer',
        'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        'shipped_weight'=>'required',

        'weight_ar.0' => 'required',
        'value_ar.0' => 'required',
        'weight_en.0' => 'required',
        'value_en.0' => 'required',

        'weight_ar.*' => 'required',
        'value_ar.*' => 'required',
        'weight_en.*' => 'required',
        'value_en.*' => 'required',
    ];



    public function add($val)
    {
     
        
        $this->i = $val + 1;

        $i =$this->i;
        $inputs=$this->inputs;
        
        array_push($this->inputs ,$i);
       // dd($this->inputs);
       
         return response()->json($inputs); //then sent this data to ajax success
       // return $i;
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    private function resetInputFields(){
        $this->weight_ar = '';
        $this->weight_en = '';
        $this->value_ar = '';
        $this->value_en = '';
    }