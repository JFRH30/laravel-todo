@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Whoops! Something went wrong!</strong>
        <br>
        <small>
            You should check the error(s) below.
        </small>
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    <small>{{ $error }}</small>
                </li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
