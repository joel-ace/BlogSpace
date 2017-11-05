@if(Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ Session::get('error') }}</li>
        </ul>
    </div>
@endif

@if(Session::has('info'))
    <div class="alert alert-info">
        <ul>
            <li>{{ Session::get('info') }}</li>
        </ul>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{{ Session::get('success') }}</li>
        </ul>
    </div>
@endif

@if(count($errors->all()) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
