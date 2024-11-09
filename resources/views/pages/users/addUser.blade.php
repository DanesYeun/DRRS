@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column m-md-2">
        <h3 class="text-start mx-2 text-primary">Add User</h3>      
        <div class="mx-2 mb-3 p-2">
            <form method="post" action="{{ route('add-user') }}" class="needs-validation" novalidate>
                @csrf
                <div class="border container bg-white rounded row mx-2 p-3">
                    <x-input name="firstname" label="First Name" type="text"/>
                    <x-input name="lastname" label="Last Name" type="text"/>

                    <x-input name="username" label="Username" type="text"/>
                    <div class="col-6 d-none d-sm-inline"></div>
                    <x-input name="emailaddress" label="Email" type="email"/>            
                    <x-select name="role" label="Role" :options="$roles" required="true"/>

                    <x-input name="password" label="Password" type="password"/>
                    <x-input name="password_confirmation" label="Confirm Password" type="password"/>


                    <div class="d-flex justify-content-end">   
                        <button type="submit" class="btn btn-success mx-2"><i class="bi bi-person-fill-add p-2"></i> Add User</button>
                    </div> 
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection