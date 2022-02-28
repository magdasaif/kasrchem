
@foreach($childs as $child)
    <option style="margin-right:{{$style_right}}px;color: {{$color}};font-size: {{$size}}px;" value="{{ $child->id }}" <?php if (collect(old('supplier_id'))->contains($child->id)) {echo 'selected';}  if($child->id == Session::get('supplier_id')){echo 'selected';}?>> -- {{ $child->name_ar }}</option>
    @if(count($child->childs))
        @include('pages.products.manageChild',['childs' => $child->childs,'style_right'=>$style_right+30,'color'=>'#4d28de','$size'=>$size-1])
    @endif
@endforeach