
@foreach($childs as $child)
        <?php
        if($type=='product'){
            if(isset($selected_supplier)){//edit
                if(in_array($child->id,$selected_supplier)){
                    $select_or_no='selected';
                }else{
                    $select_or_no='';
                }
            }else{//add
                $select_or_no='';
            }
         }elseif($type=='supplier'){
            $select_or_no='';
         }
        ?>
    <option style="margin-right:{{$margin}}px;color: {{$color}};font-size: {{$size}}px;" value="{{ $child->id }}" <?php if (collect(old('supplier_id'))->contains($child->id)) {echo 'selected';}elseif($child->id == Session::get('supplier_id')){echo 'selected';}else{echo $select_or_no;}?>> -- {{ $child->name_ar }}</option>
    @if(count($child->childs))
        @include('pages.products.manageChild',['childs' => $child->childs,'margin'=>$margin+30,'color'=>'#4d28de','size'=>$size-1,'type'=>$type])
    @endif
@endforeach