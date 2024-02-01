<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark">
<div class="container">
    <div class="row py-5 px-3">
        <div class="col-12 mb-4">
            <img class="d-block mx-auto" src="https://bellakeofest.vercel.app/assets/logo__white-13VGBVbN.svg" style="width: 200px" alt="">
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-responsive">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Teléfono</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>