@extends('backend.master')
@section('admin')
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Ticket No</th>
                    <th scope="col">Purchase Date</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Seat No</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($purchases as $key => $purchase)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                        </td>
                        <td>
                            {{ $purchase->user->name ?? '' }}
                        </td>
                        <td>
                            {{ $purchase->ticket->id ?? '' }}
                        </td>
                        <td>
                            {{ $purchase->purchase_date ?? '' }}
                        </td>
                        <td>
                            {{ $purchase->quantity ?? '' }}
                        </td>
                        <td>
                            {{ $purchase->seat_no ?? '' }}
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary ticket_edit"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" class="btn btn-danger ticket_delete"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                @empty
                    No Data Found
                @endforelse

            </tbody>
        </table>
    </div>
@endsection
