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

    <title>Online Ticketing System || Login</title>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center min-vh-100 mx-auto w-50 w-md-25">
        <form style="background: #ddd; " class="p-5 rounded-3 w-100 login_form" action="{{ route('login.submit') }}"
            method="POST">
            @csrf
            <h5 class="text-center mb-2">Login</h5>
            <div class="mb-2">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" aria-describedby="emailHelp" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="exampleInputPassword1" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Login</button>

            <p class=" mt-3">if you don't have an account. Please <a class="link-primary"
                    href="{{ route('sign.up') }}">Sign Up</a></p>
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
        $('form').submit(function(e) {
            e.preventDefault();

            // Get form data
            var email = $('#email').val();
            var password = $('#exampleInputPassword1').val();

            $.ajax({
                url: '{{ route('login.submit') }}',
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.logres
                    // Check for token and redirect
                    if (res.access_token) {
                        localStorage.setItem('token', response.access_token); // Store the token
                        window.location.href = response.redirect; // Redirect based on the user's role
                    }
                },
                error: function(error, xhr) {
                    console.log(error);
                    // Handle error
                    // toastr.warning('Invalid credentials');
                }
            });
        });
    </script>



</body>

</html>
