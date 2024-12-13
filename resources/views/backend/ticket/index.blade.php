@extends('backend.master')
@section('admin')
    <div class="d-flex justify-content-center align-items-center min-vh-100 mx-auto w-50 w-md-50 w-lg-25">
        <div class="w-100">
            <div class="d-flex justify-content-between align-items-center">
                <h5>All Tickets Manage</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ticketAddModal">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Bus Name</th>
                        <th scope="col">Travel Route</th>
                        <th scope="col">Price</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">Reached Time</th>
                        <th scope="col">Available seats</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="showData">

                </tbody>
            </table>
        </div>
    </div>


    {{-- add Ticket modal  --}}
    <!-- Modal -->
    <div class="modal fade" id="ticketAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="ticketForm">
                        <div class="mb-2">
                            <label for="name" class="form-label">Bus Name</label>

                            <select class="form-select" aria-label="Default select example" name="bus_id">
                                <option selected value="">Select Bus</option>
                                @if ($buses)
                                    @foreach ($buses as $bus)
                                        <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">No Bus Found</option>
                                @endif
                            </select>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="route_id" class="form-label">Travel Route</label>
                            <select class="form-select" aria-label="Default select example" name="route_id">
                                <option selected value="">Select Travel Route</option>
                                @if ($travelRoutes)
                                    @foreach ($travelRoutes as $travel)
                                        <option value="{{ $travel->id }}">{{ $travel->travel_name }}</option>
                                    @endforeach
                                @else
                                    <option value="">No Data Found</option>
                                @endif
                            </select>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="bus_number" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" id="price"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="time" name="start_time" class="form-control" id="start_time"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="reach_time" class="form-label">Reached Time</label>
                            <input type="time" name="reach_time" class="form-control" id="reach_time"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="total_seats" class="form-label">Available Seats</label>
                            <input type="number" name="available_seats" class="form-control" id="available_seats" required>
                            <div class="form-text text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_ticket_btn">Save</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Ticket Update Modal -->
    <div class="modal fade" id="ticketUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Ticket Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="ticketUpdateForm">
                        <div class="mb-2">
                            <label for="name" class="form-label">Bus Name</label>
                            <select class="form-select bus_id_edit" aria-label="Default select example" name="bus_id">
                                <option selected>Select Bus</option>
                                @if ($buses)
                                    @foreach ($buses as $bus)
                                        <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">No Bus Found</option>
                                @endif
                            </select>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="route_id" class="form-label ">Travel Route</label>
                            <select class="form-select route_id_edit" aria-label="Default select example"
                                name="route_id">
                                <option selected value="">Select Travel Route</option>
                                @if ($travelRoutes)
                                    @foreach ($travelRoutes as $travel)
                                        <option value="{{ $travel->id }}">{{ $travel->travel_name }}</option>
                                    @endforeach
                                @else
                                    <option value="">No Data Found</option>
                                @endif
                            </select>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="bus_number" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control price_edit" id="price"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="time" name="start_time" class="form-control start_time_edit" id="start_time"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="reach_time" class="form-label">Reached Time</label>
                            <input type="time" name="reach_time" class="form-control reach_time_edit" id="reach_time"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="total_seats" class="form-label">Available Seats</label>
                            <input type="number" name="available_seats" class="form-control available_seats_edit"
                                id="available_seats" required>
                            <div class="form-text text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_ticket_btn">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // save Ticket
        const SaveTicket = document.querySelector('.save_ticket_btn');
        SaveTicket.addEventListener('click', function(e) {
            e.preventDefault();
            let formData = new FormData($('.ticketForm')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/ticket/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(res);
                    if (res.status == 200) {
                        $('#ticketAddModal').modal('hide');
                        $('.ticketForm')[0].reset();
                        showTicketData();
                        toastr.success(res.message);
                    } else {
                        if (res.error.bus_id) {
                            toastr.error(res.error.bus_id);
                        }
                        if (res.error.route_id) {
                            toastr.error(res.error.route_id);
                        }
                        if (res.error.price) {
                            toastr.error(res.error.price);
                        }
                        if (res.error.start_time) {
                            toastr.error(res.error.start_time);
                        }
                        if (res.error.reach_time) {
                            toastr.error(res.error.reach_time);
                        }
                        if (res.error.available_seats) {
                            toastr.error(res.error.available_seats);
                        }
                    }
                }
            });
        })


        // show Ticket Data 
        function showTicketData() {
            // console.log('hello');
            $.ajax({
                url: '/ticket/view',
                method: 'GET',
                success: function(res) {
                    const tickets = res.tickets;
                    // console.log(tickets);
                    $('.showData').empty();
                    if (tickets.length > 0) {
                        $.each(tickets, function(index, ticket) {
                            // Calculate the sum of account_transaction balances
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                    <td>${index + 1}</td>
                                    <td>${ticket.bus.name ?? ""}</td>
                                    <td>${ticket.travel_route.travel_name ?? ""}</td>
                                    <td>${ticket.price ?? ""}</td>
                                    <td>${ticket.start_time ?? ""}</td>
                                    <td>${ticket.reach_time ?? ""}</td>
                                    <td>${ticket.available_seats ?? ""}</td>
                                    <td>
                                       <a href="#"  class="btn btn-primary ticket_edit" data-id="${ticket.id}" data-bs-toggle="modal" data-bs-target="#ticketUpdateModal"><i class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="#"  class="btn btn-danger ticket_delete" data-id="${ticket.id}"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                `;
                            $('.showData').append(tr);
                        });
                    } else {
                        $('.showData').html(`
                            <tr>
                                <td colspan='9'>
                                    <div class="text-center text-warning mb-2">Data Not Found</div>
                                    <div class="text-center">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ticketAddModal">Add Ticket Info</button>
                                    </div>
                                </td>
                            </tr>
                        `);
                    }
                }
            });
        }
        showTicketData();



        // edit Ticket
        $(document).on('click', '.ticket_edit', function(e) {
            e.preventDefault();
            // console.log('0k');
            let id = this.getAttribute('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `/ticket/edit/${id}`,
                type: 'GET',
                success: function(res) {
                    if (res.status == 200) {
                        const ticket = res.ticket
                        $('.bus_id_edit').val(ticket.bus_id);
                        $('.route_id_edit').val(ticket.route_id);
                        $('.price_edit').val(ticket.price);
                        $('.start_time_edit').val(ticket.start_time);
                        $('.reach_time_edit').val(ticket.reach_time);
                        $('.available_seats_edit').val(ticket.available_seats);
                        $('.update_ticket_btn').val(ticket.id);
                    } else {
                        toastr.warning("No Data Found");
                    }
                }
            });
        })

        // update ticket Data
        $('.update_ticket_btn').click(function(e) {
            e.preventDefault();
            // alert('ok');
            let id = $(this).val();
            // console.log(id);
            let formData = new FormData($('.ticketUpdateForm')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `/ticket/update/${id}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 200) {
                        $('#ticketUpdateModal').modal('hide');
                        $('.ticketUpdateForm')[0].reset();
                        showTicketData();
                        toastr.success(res.message);
                    } else {
                        if (res.error.bus_id) {
                            toastr.error(res.error.bus_id);
                        }
                        if (res.error.route_id) {
                            toastr.error(res.error.route_id);
                        }
                        if (res.error.price) {
                            toastr.error(res.error.price);
                        }
                        if (res.error.start_time) {
                            toastr.error(res.error.start_time);
                        }
                        if (res.error.reach_time) {
                            toastr.error(res.error.reach_time);
                        }
                        if (res.error.available_seats) {
                            toastr.error(res.error.available_seats);
                        }
                    }
                }
            });
        })

        // bank Delete
        $(document).on('click', '.ticket_delete', function(e) {
            // $('.bank_delete').click(function(e) {
            e.preventDefault();
            let id = this.getAttribute('data-id');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be Delete this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: `/ticket/delete/${id}`,
                        type: 'GET',
                        success: function(data) {
                            if (data.status == 200) {
                                toastr.success(data.message);
                                showTicketData();
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: data.message,
                                    footer: '<a href="#">Why do I have this issue?</a>'
                                });
                            }
                        }
                    });
                }
            });
        })
    </script>
@endsection
