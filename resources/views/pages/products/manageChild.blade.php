
@foreach($childs as $child)
        <?php
        if($type=='product')
        {
            if(isset($selected_supplier))
            {//edit
                if(in_array($child->id,$selected_supplier)){
                    $select_or_no='selected';
                }else{
                    $select_or_no='';
                }
            }
            else
            {//add
                $select_or_no='';
            }
         }
         elseif($type=='supplier')
         {
            $select_or_no='';
         }
         elseif($type=='site_section')
         {
            $select_or_no='';
         }
         $extra='';
         for($i=1;$i<=$number;$i++){
            $extra.='-';
         }
       
     if($type=='site_section')
     { ?>
        <option style="color: {{$color}};" value="{{ $child->id }}" <?php echo $select_or_no;?>> <?php echo $extra;?> {{ $child->site_name_ar }}</option>
        @if(count($child->childs))
          @include('pages.products.manageChild',['childs' => $child->childs,'font-family'=>'monospace','color'=>'#4d28de','type'=>$type,'number'=>$number+1])
          @endif
     <?php
     }

     else 
     {
         
         ?>
        <option style="margin-right:{{$margin}}px;font-family:Cursive;color: {{$color}};font-size: {{$size}}px;" value="{{ $child->id }}" <?php if (collect(old('supplier_id'))->contains($child->id)) {echo 'selected';}elseif($child->id == Session::get('supplier_id')){echo 'selected';}else{echo $select_or_no;}?>> <?php echo $extra;?> {{ $child->name_ar }}</option>
        @if(count($child->childs))
        @include('pages.products.manageChild',['childs' => $child->childs,'margin'=>$margin+30,'font-family'=>'monospace','color'=>'#4d28de','size'=>$size-2,'type'=>$type,'number'=>$number+1])
    @endif
         
    <?php
     }
     
     ?>
     
   
@endforeach