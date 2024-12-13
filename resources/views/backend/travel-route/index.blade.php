@extends('backend.master')
@section('admin')
    <div class="d-flex justify-content-center align-items-center min-vh-100 mx-auto w-50 w-md-50 w-lg-25">
        <div class="w-100">
            <div class="d-flex justify-content-between align-items-center">
                <h5>All Travel Route Manage</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dataAddModal">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Travel Name</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="showData">

                </tbody>
            </table>
        </div>
    </div>


    <!-- add Travel Route modal -->
    <div class="modal fade" id="dataAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Travel Route</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="saveForm">
                        <div class="mb-2">
                            <label for="from" class="form-label">From</label>
                            <input type="text" name="from" class="form-control" id="from"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="to" class="form-label">To</label>
                            <input type="text" name="to" class="form-control" id="to"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_data">Save</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Ticket Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Ticket Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="updateForm">
                        <div class="mb-2">
                            <label for="from" class="form-label">From</label>
                            <input type="text" name="from" class="form-control from_edit" id="from"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                        <div class="mb-2">
                            <label for="to" class="form-label">To</label>
                            <input type="text" name="to" class="form-control to_edit" id="to"
                                aria-describedby="emailHelp" required>
                            <div class="form-text text-danger"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_data">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // save Data
        const saveData = document.querySelector('.save_data');
        saveData.addEventListener('click', function(e) {
            e.preventDefault();
            let formData = new FormData($('.saveForm')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/travel-route/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    // console.log(res);
                    if (res.status == 200) {
                        $('#dataAddModal').modal('hide');
                        $('.saveForm')[0].reset();
                        showAllData();
                        toastr.success(res.message);
                    } else {
                        if (res.error.from) {
                            toastr.error(res.error.from);
                        }
                        if (res.error.to) {
                            toastr.error(res.error.to);
                        }
                    }
                }
            });
        })


        // show Ticket Data 
        function showAllData() {
            // console.log('hello');
            $.ajax({
                url: '/travel-route/view',
                method: 'GET',
                success: function(res) {
                    const travelRoutes = res.travelRoutes;
                    // console.log(banks.account_transaction);
                    $('.showData').empty();
                    if (travelRoutes.length > 0) {
                        $.each(travelRoutes, function(index, route) {
                            // Calculate the sum of account_transaction balances
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                    <td>${index + 1}</td>
                                    <td>${route.travel_name ?? ""}</td>
                                    <td>${route.from ?? ""}</td>
                                    <td>${route.to ?? ""}</td>
                                    <td>
                                       <a href="#"  class="btn btn-primary data_edit" data-id="${route.id}" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="#"  class="btn btn-danger data_delete" data-id="${route.id}"><i class="fa-solid fa-trash-can"></i></a>
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
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dataAddModal">Add Route Info</button>
                                    </div>
                                </td>
                            </tr>
                        `);
                    }
                }
            });
        }
        showAllData();



        // edit Data
        $(document).on('click', '.data_edit', function(e) {
            e.preventDefault();
            // console.log('0k');
            let id = this.getAttribute('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `/travel-route/edit/${id}`,
                type: 'GET',
                success: function(res) {
                    if (res.status == 200) {
                        const route = res.travelRoute
                        $('.from_edit').val(route.from);
                        $('.to_edit').val(route.to);
                        $('.update_data').val(route.id);
                    } else {
                        toastr.warning("No Data Found");
                    }
                }
            });
        })

        // update ticket Data
        $('.update_data').click(function(e) {
            e.preventDefault();
            // alert('ok');
            let id = $(this).val();
            // console.log(id);
            let formData = new FormData($('.updateForm')[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `/travel-route/update/${id}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 200) {
                        $('#updateModal').modal('hide');
                        $('.updateForm')[0].reset();
                        showAllData();
                        toastr.success(res.message);
                    } else {
                        if (res.error.from) {
                            toastr.error(res.error.from);
                        }
                        if (res.error.to) {
                            toastr.error(res.error.to);
                        }
                    }
                }
            });
        })

        // bank Delete
        $(document).on('click', '.data_delete', function(e) {
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
                        url: `/travel-route/delete/${id}`,
                        type: 'GET',
                        success: function(data) {
                            if (data.status == 200) {
                                toastr.success(data.message);
                                showAllData();
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
