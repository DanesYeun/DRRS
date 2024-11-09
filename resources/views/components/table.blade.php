@props(['users' => null, 'label'])
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
                <th scope="col" class="p-3 bg-primary text-white">Status</th>
                <th scope="col" class="p-3 rounded-end bg-primary text-white">Action</th>
            </tr>
        </thead>
        <tbody id="tableBody"></tbody>
    </table>

    <!-- Pagination -->
    <nav class="pagination-container">
        <ul class="pagination justify-content-end" id="pagination"></ul>
    </nav>
</div>

<script src="{{ asset('js/table.js') }}"></script>