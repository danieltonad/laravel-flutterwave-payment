@extends('layout.dashboard')

@section('content')
    <div class="col-lg-8 col-md-10 col-11 mx-auto my-5 text-center mt-3">

        <div class="display-4 text-muted user-type text-center">
            {{ $message }}
        </div>

        {{-- redirect user to dashboard --}}
        <script>
            setTimeout(() => {
                window.location.replace('/dashboard');
            }, 1000);
        </script>
    </div>
@endsection
