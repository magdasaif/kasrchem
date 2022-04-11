
  @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}

            @if(Session::has('data'))
                <ol> 
                    @foreach(session::get('data')  as $d)
                        <li style="color:green;font-size:15px">{{$d}}</li>
                    @endforeach
                    </ol>
            @endif
    
        </div>
    @endif