@foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" <?php if (collect(old('supplier_id'))->contains($supplier->id)) {echo 'selected';}  if($supplier->id == Session::get('supplier_id')){echo 'selected';}?>> - {{ $supplier->name_ar }}</option>
                            @if(count($supplier->childs))
                                @include('pages.products.manageChild',['childs' => $supplier->childs])
                            @endif
                        @endforeach


                        @foreach($childs as $child)
    <option value="{{ $child->id }}" <?php if (collect(old('supplier_id'))->contains($child->id)) {echo 'selected';}  if($child->id == Session::get('supplier_id')){echo 'selected';}?>> -- {{ $child->name_ar }}</option>
    @if(count($child->childs))
        @include('pages.products.manageChild',['childs' => $child->childs])
    @endif
@endforeach

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
<!-- <script src="{{ URL::asset('/js/treeview.js') }}"></script> -->
<!-- <link href="{{ URL::asset('/css/treeview.css') }}" rel="stylesheet"> -->

                <div class="col-md-6">
	  					<h3>Category List</h3>
				        <ul id="tree1">
				            @foreach($suppliers as $supplier)
				                <li>
				                    {{ $supplier->name_ar }}
				                    @if(count($supplier->childs))
				                        @include('pages.products.manageChild',['childs' => $supplier->childs])
				                    @endif
				                </li>
				            @endforeach
				        </ul>
	  				</div>
                      
                        <ul>
@foreach($childs as $child)
	<li>
	    {{ $child->name_ar }}
	@if(count($child->childs))
            @include('pages.products.manageChild',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>
