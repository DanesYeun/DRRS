@props(['label', 'datas' => null])
<div class="container mt-2 table-container">   
    <div class="mb-1 d-flex justify-content-between">
        <h5 class="p-1">{{ $label }}</h5>
            <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">  
    </div>
    <table id="assistance-table" class="table table-hover table-borderless">
        <thead class="rounded-top">
            <tr>
                <th scope="col" class="p-3 rounded-start bg-primary text-white">Date</th>
                <th scope="col" class="p-3 bg-primary text-white">Reporter Name</th>
                <th scope="col" class="p-3 bg-primary text-white">Reporter Contact No.</th>
                <th scope="col" class="p-3 bg-primary text-white">Case</th>
                <th scope="col" class="p-3 rounded-end bg-primary text-white">Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach($datas as $data)
                <tr>
                    <td class="p-3 rounded-start">
                        {{ \Carbon\Carbon::parse($data->date)->format('M d, Y') }}
                    </td>
                    <td class="p-3">{{ $data->reporterFullName }}</td>
                    <td class="p-3">{{ $data->reporterContactNumber }}</td>
                    <td class="p-3">{{ $data->incidentCase->description }}</td>
                    <td class="p-3 rounded-end">
                        <a class="btn btn-sm btn-warning text-white" href="{{ route('show-incident-report', ['case' => $data->incidentCase->id, 'id' => $data->reportID]) }}">View</a>
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

@section('js')
<script src="{{ asset('js/searchbox-table.js') }}"></script>
<script src="{{ asset('js/pagination.js') }}"></script>
{{-- for pagination --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const data = @json($datas); 
        paginateTable('assistance-table', data, 5);
        document.getElementById("searchInput").addEventListener("input", function() {
            searchTable("searchInput", "assistance-table");
        });
    });
</script>
{{-- for searchbox --}}
<script>
    document.getElementById("searchInput").addEventListener("input", function() {
        searchTable("searchInput", "assistance-table");
    });
</script>
@endsection

