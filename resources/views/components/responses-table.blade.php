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
                <th scope="col" class="p-3 bg-primary text-white">Patient</th>
                <th scope="col" class="p-3 bg-primary text-white">Case</th>
                <th scope="col" class="p-3 bg-primary text-white">Responders</th>
                <th scope="col" class="p-3 rounded-end bg-primary text-white">Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @foreach($datas as $data)
                <tr>
                    <td class="p-3 rounded-start">
                        <!-- Carbon is used since date's data type is not 'timestamp' -->
                        {{ \Carbon\Carbon::parse($data->date)->format('M d, Y') }}
                    </td>
                    <td class="p-3">{{ $data->patientName }}</td>
                    <td class="p-3">{{ $data->case->description }}</td>
                    <td class="p-3 ">{{ $data->responders }}</td>
                    <td class="p-3 rounded-end">
                        <a class="btn btn-sm btn-warning text-white" href="{{ route('response_records.edit', ['id' => $data->responseID]) }}">Edit</a>
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
