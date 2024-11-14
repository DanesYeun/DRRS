@props(['label', 'datas' => null])
<div class="container mt-2 table-container">   
    <div class="mb-1 d-flex justify-content-between">
        <h5 class="p-1 text-primary">{{ $label }}</h5>
            <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">  
    </div>
    <table class="table table-hover table-striped table-borderless">
        <thead class="rounded-top">
            <tr>
                <th scope="col" class="p-3 rounded-start bg-primary text-white">Name</th>
                <th scope="col" class="p-3 bg-primary text-white">Status</th>
                <th scope="col" class="p-3 bg-primary text-white">Created At</th>
                <th scope="col" class="p-3 rounded-end bg-primary text-white">Action</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach($datas as $data)
                <tr>
                    <td class="p-3 rounded-start">{{ $data->hazardName }}</td>
                    <td class="p-3">
                        <small class="badge rounded-pill {{ $data->hazardStatus == 1 ? 'bg-success' : 'bg-danger'}}">
                            {{ $data->hazard_status->description }}
                        </small> 
                    </td>
                    <td class="p-3">{{ $data->created_at->diffForHumans() }}</td>
                    <td class="p-3 rounded-end">
                        <a class="btn btn-sm btn-primary text-white" href="{{ route('hazard_map.edit', ['id' => $data->hazardID]) }}">Edit</a>
                        <form action="{{ route('hazard_map.disable', ['id' => $data->hazardID]) }}" method="POST" style="display: inline;">
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
