@props(['label', 'datas' => null, 'type'])
<div class="container mt-2 table-container"> 
    <div class="table-responsive">
        <table class="table table-hover table-borderless">
            <thead class="rounded-top">
                <tr>
                    <th scope="col" class="p-3 rounded-start bg-primary text-white">Date</th>
                    <th scope="col" class="p-3 bg-primary text-white">Name</th>
                    <th scope="col" class="p-3 bg-primary text-white">ContactNo</th>
                    @if($type == 1)
                        <th scope="col" class="p-3 bg-primary text-white">Amount</th>
                    @endif
                    @if($type == 2)
                        <th scope="col" class="p-3 bg-primary text-white">Category</th>
                        <th scope="col" class="p-3 bg-primary text-white">Item Name</th>
                        <th scope="col" class="p-3 bg-primary text-white">Quantity</th>
                    @endif
                    <th scope="col" class="p-3 bg-primary text-white">Mode</th>
                    <th scope="col" class="p-3 rounded-end bg-primary text-white">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach($datas as $data)
                    <tr>
                        <td class="p-3 rounded-start">
                            <!-- Carbon is used since date's data type is not 'timestamp' -->
                            {{ \Carbon\Carbon::parse($data['created_at'])->format('M d, Y') }}
                        </td>
                        <td class="p-3">{{ $data['fullname'] }}</td>
                        <td class="p-3">{{ $data['contactno']}}</td>
                        @if($type == 1)
                            <td class="p-3 ">{{ $data['amount'] }}</td>
                        @endif
                        @if($type == 2)
                            <td class="p-3 ">{{ $data['categoryDesc'] }}</td>
                            <td class="p-3 ">{{ $data['itemName'] }}</td>
                            <td class="p-3 ">{{ $data['quantity'] }}</td>
                        @endif
                        <td class="p-3 ">{{ $data['donationModeDesc'] }}</td>
                        
                        <td class="p-3 rounded-end">
                            @if($data['donationMode'] == 2 && $data['isPickUp'] == 0 && Auth::user()->role == 3)
                                <a class="btn btn-sm btn-success text-white" href=""
                                    onclick="event.preventDefault(); document.getElementById('pickup-form').submit();">
                                    <i class="bi bi-check-circle"></i> 
                                </a>

                                <form id="pickup-form" action="{{ route('pickup.donation', ['type' => $type, 'id' => $data['donationID']]) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endif
                            <a class="btn btn-sm btn-warning text-white" href="{{ route('print.donation', ['type' => $type, 'id' => $data['donationID']]) }}">
                                <i class="bi bi-printer"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav class="pagination-container">
        <ul class="pagination justify-content-end" id="pagination"></ul>
    </nav>
</div>
