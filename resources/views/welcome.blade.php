<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Import Excel</title>
</head>

<body>

    <h1>Latihan Import Data Excel</h1>

    @if (session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="color:red;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".xlsx,.xls,.csv" required>
        <button type="submit">Import</button>
    </form>

    @if (session('data'))
        <h2>Preview Data</h2>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Instansi</th>
                </tr>
            </thead>

            <tbody>
                @foreach (session('data') as $index => $row)
                    @if ($index != 0)
                        <tr>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }}</td>
                            <td>{{ $row[2] }}</td>
                            <td>{{ $row[3] }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

</body>

</html>
