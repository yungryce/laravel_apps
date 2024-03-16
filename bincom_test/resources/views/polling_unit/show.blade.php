<!-- resources/views/polling_unit/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling Unit Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        table {
            width: 50%;
            margin: 0 auto;
            border-collapse: collapse;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Result of Polling Unit {{ $result->first()->polling_unit_uniqueid }}</h1>

    <table>
        <thead>
            <tr>
                <th>Party</th>
                <th>Results</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $row)
            <tr>
                <td>{{ $row->party_abbreviation }}</td>
                <td>{{ $row->party_score }}</td>
            </tr>
            @endforeach
            <tr>
                <td><strong>Total:</strong></td>
                <td>{{ $totalScore }}</td>
            </tr>
        </tbody>
    </table>


    <div class="btn-container">
        <a href="/" class="btn btn-primary">Return</a>
    </div>
</body>
</html>
