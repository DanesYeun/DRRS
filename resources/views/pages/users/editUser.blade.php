@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <h3 class="text-start mx-2 text-primary">Edit User</h3>      
        <div class="mx-2 mb-3 p-2">
            <form method="post" action="{{ route('edit-user', ['id' => $userDetails->id]) }}" class="needs-validation" novalidate>
                @csrf
                <div class="border container bg-white rounded row mx-2 p-3">
                
                    <x-input name="firstname" label="First Name" type="text" value="{{ $userDetails->firstname }}"/>
                    <x-input name="lastname" label="Last Name" type="text" value="{{ $userDetails->lastname }}"/>

                    <x-input name="username" label="Username" type="text" value="{{ $userDetails->username }}"/>
                    <div class="col-6 d-none d-sm-inline"></div>
                    <x-input name="emailaddress" label="Email" type="email" value="{{ $userDetails->emailaddress }}"/>            
                    <x-select name="role" label="Role" :options="$roles" required="true" value="{{ $userDetails->role }}"/>

                    <div class="d-flex justify-content-end">   
                        <button type="submit" class="btn btn-success mx-2"><i class="bi bi-person-fill-down p-2"></i> Save Changes</button>
                    </div>
                    
                </div>
            </form>
        </div>    
    </div>
@endsection

@section('js')
@endsection