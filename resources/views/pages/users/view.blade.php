@extends('layouts.layout')

@section('content')
    <div class="d-flex flex-column flex-md-row m-md-5">
        
    <table class="table table-hover">
    <thead class="rounded-top">
        <tr>
            <th scope="col" class="p-3 rounded-start bg-primary text-white">#</th>
            <th scope="col" class="p-3 bg-primary text-white">First</th>
            <th scope="col" class="p-3 bg-primary text-white">Last</th>
            <th scope="col" class="p-3 rounded-end bg-primary text-white">Handle</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <tr class="mt-2 round">
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
        </tr>
    </tbody>
</table>



    </div>
@endsection

@section('js')
    <!-- Import password toggle js -->
    <script src="{{ asset('js/togglePassword.js') }}"></script>
@endsection