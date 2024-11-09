@props(['label', 'datas'])
<div class="container mt-2 table-container">   
    <div class="mb-1 d-flex justify-content-between">
        <h5 class="p-1">{{ $label }}</h5>
            <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">  
    </div>
    <table class="table table-hover table-borderless">
        <thead class="rounded-top">
            <tr>
                <th scope="col" class="p-3 rounded-start bg-primary text-white">ID</th>
                <th scope="col" class="p-3 bg-primary text-white">Name</th>
                <th scope="col" class="p-3 bg-primary text-white">Email</th>
                <th scope="col" class="p-3 bg-primary text-white">Status</th>
                <th scope="col" class="p-3 rounded-end bg-primary text-white">Action</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach($datas as $data)
                <tr>
                    <td class="p-3">{{ $data->id }}</td>
                    <td class="p-3">{{ $data->firstname }} {{ $data->lastname }}</td>
                    <td class="p-3">{{ $data->emailaddress }}</td>
                    <td class="p-3">{{ $data->status ? 'Active' : 'Inactive' }}</td>
                    <td class="p-3">
                        <a class="btn btn-sm btn-primary" href="{{ route('details', ['id' => $data->id]) }}">Edit</a>
                        <form action="{{ route('disable-user-account', ['id' => $data->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Disable</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <nav class="pagination-container">
        <ul class="pagination justify-content-end" id="pagination"></ul>
    </nav>
</div>
