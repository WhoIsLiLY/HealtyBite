<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Foods</title>
</head>

<body>
    <h1>List of Foods</h1>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>category</th>
                <th>description</th>
                <th>nutrition fact</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($food as $f)
            <tr>
                <td>{{ $f->id }}</td>
                <td>{{ $f->name }}</td>
                <td>{{ $f->category_id }}</td>
                <td>{{ $f->description }}</td>
                <td>{{ $f->nutrition_fact }}</td>
                <td>{{ $f->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <pre>{{ $food }}</pre>
</body>
</html>