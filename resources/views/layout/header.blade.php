
@php
    use App\Models\credentials;
    $credential = credentials::with(['permission'])->findOrFail(session('user_id'));
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand text-primary" href="#">
            <p>Timber House Enterprise</p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">

                @if (in_array('DOCUMENTS',json_decode($credential->permission->permissions) ))
                    <a class="nav-link" aria-current="page" href="{{ route('showplates') }}">Documents</a>
                @endif
                @if (in_array('PRODUCTS',json_decode($credential->permission->permissions) ))
                    <a class="nav-link" href="{{ route('products.users') }}">Products</a>
                @endif
                @if (in_array('ATTENDENCE',json_decode($credential->permission->permissions) ))
                    <a class="nav-link" href="{{ route('attendence.index') }}">Attendance</a>
                @endif
                @if (in_array('CFT',json_decode($credential->permission->permissions) ))
                    <a class="nav-link" href="{{ route('calculator.index') }}">CFT</a>
                @endif
                @if (in_array('CHEQUE',json_decode($credential->permission->permissions) ))
                    <a class="nav-link" href="{{ route('cheque.index') }}">CHEQUE</a>
                @endif
                @if (in_array('MISC',json_decode($credential->permission->permissions) ))
                    <a class="nav-link" href="{{ route('misc.index') }}">CHEQUE</a>
                @endif





                <a class="nav-link" href="{{ route('login') }}">Logout</a>
            </div>
        </div>
    </div>
</nav>
