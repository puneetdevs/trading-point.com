<div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-4 mb-4" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::has('error'))
        <div class="alert alert-danger mt-4" role="alert">
            <strong>{{ $message }}</strong>
            {{ Session::get('error') }}
        </div>
    @endif
</div>


{{-- @if ($errors->any())
<div class="alert alert-warning mt-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif --}}
