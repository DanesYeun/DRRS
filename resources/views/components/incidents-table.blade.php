@props(['label', 'datas' => null])
<div class="container mt-2 table-container">   
    <div class="mb-1 d-flex justify-content-between">
        <h5 class="p-1">{{ $label }}</h5>
            <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">  
    </div>
    <table class="table table-hover table-borderless">
        <thead class="rounded-top">
            <tr>
                <th scope="col" class="p-3 rounded-start bg-primary text-white">Date</th>
                <th scope="col" class="p-3 bg-primary text-white">Patient Name</th>
                <th scope="col" class="p-3 bg-primary text-white">Type</th>
                <th scope="col" class="p-3 rounded-end bg-primary text-white">Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach($datas as $data)
                <tr>
                    <td class="p-3 rounded-start">{{ $data->date }}</td>
                    <td class="p-3">{{ $data->patientName }}</td>
                    <td class="p-3">{{ $data->typeDescription }}</td>
                    <td class="p-3 rounded-end">
                        <a class="btn btn-sm btn-warning text-white" href="{{ route('show-incident-report', ['id' => $data->reportID]) }}">View</a>
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
