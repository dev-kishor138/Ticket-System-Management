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
    {{-- toaster css  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <title>Online Ticketing System || Sign Up </title>
    <style>
        .is-invalid {
            border-color: red !important;
            background-color: #fdd;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100 mx-auto w-50 w-md-50 w-lg-25">
        <form style="background: #ddd; " class="p-5 rounded-3 w-100 sign_up_form needs-validation">
            <h5 class="text-center mb-2">Sign Up</h5>
            <div class="mb-2">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
                <div class="form-text text-danger"></div>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                    required>
                <div class="form-text text-danger"></div>
            </div>
            <div class="mb-2">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                <div class="form-text text-danger"></div>
            </div>
            <button type="submit" class="btn btn-primary register_btn">Register</button>

            <p class=" mt-3">if you have an account. Please <a class="link-primary"
                    href="{{ route('login') }}">Login</a></p>
        </form>
    </div>


    <!-- Bootstrap Js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- jquery plugin  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- toaster js  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        const registerBtn = document.querySelector('.register_btn');
        registerBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const form = document.querySelector('.sign_up_form');
            let formData = new FormData(form);

            $.ajax({
                url: '/register',
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF_TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    if (res.status == 200) {
                        console.log(res);
                        toastr.success(res.message);
                        window.location.href = '/login-page';
                    } else {
                        if (res.error.name) {
                            toastr.warning(res.error.name);
                        }
                        if (res.error.email) {
                            toastr.warning(res.error.email);
                        }
                        if (res.error.password) {
                            toastr.warning(res.error.password);
                        }
                    }
                },
                error: function(error) {
                    toastr.error('An unexpected error occurred. Please try again.');
                }
            })

        })
    </script>
</body>

</html>
