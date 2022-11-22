<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user view</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">fullname</th>
                <th scope="col">username</th>
                <th scope="col">email</th>
                <th scope="col">phone_number</th>
                <th scope="col">age</th>
                <th scope="col">address</th>
                <th scope="col">password</th>
                <th scope="col">role</th>
                <th scope="col" colspan="2" class="text-center">action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->fullName }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phoneNumber }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->role }}</td>
                    <td><a href="{{ route('user.edit', $user->id) }}">update</a></td>
                    <td>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>