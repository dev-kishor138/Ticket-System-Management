@extends('backend.master')
@section('admin')
    <div class="d-flex justify-content-center align-items-center min-vh-100 mx-auto w-50 w-md-50 w-lg-25">
        <div class="w-100">
            <div class="d-flex justify-content-between align-items-center">
                <h5>All Bus Manage</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#busAddModal">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Bus Name</th>
                        <th scope="col">Total seats</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="showData">

                </tbody>
            </table>
        </div>
    </div>


    {{-- add Bus modal  --}}
    <!-- Modal -->
    <div class="modal fade" id="busAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Bus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="busForm">
                        <div class="mb-2">
                            <label for="name" class="form-label">Bus Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="bus_number" class="form-label">Bus Number</label>
                            <input type="text" name="bus_number" class="form-control" id="bus_number"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="total_seats" class="form-label">Total Seats</label>
                            <input type="number" name="total_seats" class="form-control" id="total_seats" required>
                            <div class="form-text text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_bus_btn">Save</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bus Update Modal -->
    <div class="modal fade" id="busUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Bus Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="busUpdateForm">
                        <div class="mb-2">
                            <label for="name" class="form-label">Bus Name</label>
                            <input type="text" name="name" class="form-control bus_name_edit" id="name" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="bus_number" class="form-label">Bus Number</label>
                            <input type="text" name="bus_number" class="form-control bus_number_edit" id="bus_number"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="total_seats" class="form-label">Total Seats</label>
                            <input type="number" name="total_seats" class="form-control total_seats_edit"
                                id="total_seats" required>
                            <div class="form-text text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_bus_btn">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // save Bus
        const SaveBus = document.querySelector('.save_bus_btn');
        SaveBus.addEventListener('click', function(e) {
            e.preventDefault();
            let formData = new FormData($('.busForm')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/bus/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 200) {
                        $('#busAddModal').modal('hide');
                        $('.busForm')[0].reset();
                        showBusData();
                        toastr.success(res.message);
                    } else {
                        if (res.error.name) {
                            toastr.error(res.error.name);
                        }
                        if (res.error.bus_number) {
                            toastr.error(res.error.bus_number);
                        }
                        if (res.error.total_seats) {
                            toastr.error(res.error.total_seats);
                        }
                    }
                }
            });
        })


        // show Bus Data 
        function showBusData() {
            // console.log('hello');
            $.ajax({
                url: '/bus/view',
                method: 'GET',
                success: function(res) {
                    const buses = res.buses;
                    // console.log(banks.account_transaction);
                    $('.showData').empty();
                    if (buses.length > 0) {
                        $.each(buses, function(index, bus) {
                            // Calculate the sum of account_transaction balances
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                    <td>${index + 1}</td>
                                    <td>${bus.name ?? ""}</td>
                                    <td>${bus.total_seats ?? ""}</td>
                                    <td>
                                       <a href="#"  class="btn btn-primary bus_edit" data-id="${bus.id}" data-bs-toggle="modal" data-bs-target="#busUpdateModal"><i class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="#"  class="btn btn-danger bus_delete" data-id="${bus.id}"><i class="fa-solid fa-trash-can"></i></a>
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
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#busAddModal">Add Bus Info</button>
                                    </div>
                                </td>
                            </tr>
                        `);
                    }
                }
            });
        }
        showBusData();



        // edit Bus
        $(document).on('click', '.bus_edit', function(e) {
            e.preventDefault();
            // console.log('0k');
            let id = this.getAttribute('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `/bus/edit/${id}`,
                type: 'GET',
                success: function(res) {
                    if (res.status == 200) {
                        const bus = res.bus
                        $('.bus_name_edit').val(bus.name);
                        $('.total_seats_edit').val(bus.total_seats);
                        $('.bus_number_edit').val(bus.bus_number);
                        $('.update_bus_btn').val(bus.id);
                    } else {
                        toastr.warning("No Data Found");
                    }
                }
            });
        })

        // update bus Data
        $('.update_bus_btn').click(function(e) {
            e.preventDefault();
            // alert('ok');
            let id = $(this).val();
            // console.log(id);
            let formData = new FormData($('.busUpdateForm')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `/bus/update/${id}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 200) {
                        $('#busUpdateModal').modal('hide');
                        $('.busUpdateForm')[0].reset();
                        showBusData();
                        toastr.success(res.message);
                    } else {
                        if (res.error.name) {
                            toastr.error(res.error.name);
                        }
                        if (res.error.bus_number) {
                            toastr.error(res.error.bus_number);
                        }
                        if (res.error.total_seats) {
                            toastr.error(res.error.total_seats);
                        }
                    }
                }
            });
        })

        // bank Delete
        $(document).on('click', '.bus_delete', function(e) {
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
                        url: `/bus/delete/${id}`,
                        type: 'GET',
                        success: function(data) {
                            if (data.status == 200) {
                                toastr.success(data.message);
                                showBusData();
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
