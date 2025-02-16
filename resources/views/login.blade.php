<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
    <title>Login | Kasir</title>
</head>

<body class="bg-blue-800">
    <section class="min-h-screen flex justify-center items-center">
        <div class="bg-white p-8 rounded-md shadow-md">
            <h1 class="text-xl font-semibold mb-10 leading-tight tracking-tight">Masuk untuk memulai <span
                    class="text-textColor">Aplikasi Kasir</span></h1>
            <form action="/login/store" method="POST">
                @csrf
                @method('POST')
                <div class="flex flex-col mb-4 space-y-2">
                    <label for="email" class="font-medium">Email</label>
                    <input type="text" id="email" name="email" placeholder="Masukan email" required
                        class="block w-full border border-gray-300 rounded-lg focus:outline-none focus:border-gray-700 py-2 px-4 ">
                </div>
                <div class="flex flex-col mb-6 space-y-2">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukan Password" required
                        class="block w-full border border-gray-300 rounded-lg focus:outline-none focus:border-gray-700 py-2 px-4 ">
                </div>
                <button method="submit" class="w-full bg-textColor text-white py-2 rounded-md">Masuk</button>
            </form>
        </div>
    </section>
    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: '{{ $errors->first() }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Coba Lagi'
            });
        @endif
    </script>

</body>

</html>