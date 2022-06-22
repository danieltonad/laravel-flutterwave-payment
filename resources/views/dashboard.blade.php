@extends('layout.dashboard')

@section('content')
    <div class="col-lg-8 col-md-10 col-11 mx-auto my-5 mt-3">



        {{-- {{$user}} --}}

        @if ($user->user_type == ADMIN)
            <div style="font-size: 2rem" class="title text-lead mt-4">
                Hi Admin,
            </div>
            <div class="container-fluid my-3 mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">User Type</th>
                        </tr>
                    </thead>




                    <tbody>
                        @if (count($user_list) > 0)
                            @foreach ($user_list as $users)
                                <tr>
                                    <th scope="row">{{ $users->id }}</th>
                                    <td>{{ $users->fullname }}</td>
                                    <td>{{ $users->username }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>{{ userType($users->user_type) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th class="text-center py-5" colspan="5" scope="row">
                                    User List Empty
                                </th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endif

        @if ($user->user_type == PAID_USER)
            <div style="font-size: 1.5rem" class="title text-grey mt-4">
                Hi {{ $user->fullname }},
            </div>
            <div class="text-muted user-type display-4">
                PAID USER
            </div>
        @endif

        @if ($user->user_type == FREE_USER)
            <div style="font-size: 1.5rem" class="title text-lead mt-4">
                Hi {{ $user->fullname }},
            </div>
            <div class="text-muted user-type ">
                <div class="display-4">FREE USER</div>

                <div class="upgrade mt-3">
                    <a href="{{ URL::to('upgrade/')}}">Upgrade Plan</a>
                </div>
                

            </div>
        @endif
    </div>
@endsection
