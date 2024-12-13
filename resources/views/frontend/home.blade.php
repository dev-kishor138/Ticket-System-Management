<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Toastr Css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Online Ticketing System</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">OT System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                </ul>
                <form class="d-flex">
                    {{-- <button class="btn btn-outline-success" type="submit">Login</button> --}}
                    <a class="btn btn-outline-success" href="{{ route('login') }}">Login</a>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h4 class="text-center mb-3">All Tickets</h4>
        <div class="row">
            @forelse ($tickets as $ticket)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ticket->bus->name }}</h5>
                            <p class="card-text"><i class="fa-solid fa-location-dot"></i>
                                {{ $ticket->travelRoute->travel_name }}</p>
                            <p class="card-text"><i class="fa-solid fa-money-check-dollar"></i> {{ $ticket->price }} Tk
                            </p>
                            <p class="card-text"><i class="fa-solid fa-clock"></i> {{ $ticket->start_time }} AM
                            </p>
                            <p class="card-text"><i class="fa-solid fa-couch"></i> {{ $ticket->available_seats }} Seats
                                Available
                            </p>
                            <a href="#" class="btn btn-primary tickets_add" data-id='{{ $ticket->id }}'>Purchase
                                Tickets</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No Data Found</p>
            @endforelse
        </div>

    </div>



    <!-- Seats modal -->
    <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chose Your Seat</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <br>
                <p class="text-center">You can choose at Least One Tickets</p>
                <div class="modal-body">
                    <form class="saveForm row">
                        <div class="mb-2 col-md-6">
                            <label for="from" class="form-label">1st Series</label>
                            <select class="form-select" name="first_series">
                                <option selected value="">Select 1st Series</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">I</option>
                                <option value="J">J</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="from" class="form-label">2nd Series</label>
                            <select class="form-select" aria-label="Default select example" name="second_series">
                                <option selected value="">Select 2nd Series</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">I</option>
                                <option value="J">J</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="from" class="form-label">3rd Series</label>
                            <select class="form-select" aria-label="Default select example" name="third_series">
                                <option selected value="">Select 3rd Series</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">I</option>
                                <option value="J">J</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="from" class="form-label">4th Series</label>
                            <select class="form-select" aria-label="Default select example" name="fourth_series">
                                <option selected value="">Select 4th Series</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="I">I</option>
                                <option value="J">J</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary ticket_purchase" value="">Purchase</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap Js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- jquery plugin  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Toastr Js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        // purchase
        $(document).on('click', '.tickets_add', function(e) {
            e.preventDefault();
            // console.log('0k');
            let id = this.getAttribute('data-id');
            console.log(id);

            if (id) {
                $('.ticket_purchase').val(id);
                let modal = new bootstrap.Modal(document.getElementById('purchaseModal'));
                modal.show();
            } else {
                toastr.warning('Data Not found')
            }
        })

        // save Data
        const ticketPurchase = document.querySelector('.ticket_purchase');
        ticketPurchase.addEventListener('click', function(e) {
            e.preventDefault();
            let formData = new FormData($('.saveForm')[0]);
            const id = $(this).val();
            formData.append('id', id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/purchase/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    // console.log(res);
                    if (res.status == 200) {
                        $('#purchaseModal').modal('hide');
                        $('.saveForm')[0].reset();
                        toastr.success(res.message);
                    } else {
                        toastr.error('something went wrong when ticket purchase');
                    }
                }
            });
        })
    </script>
</body>

</html>
