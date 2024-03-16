<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling Results</title>
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
        select {
            display: block;
            margin: 0 auto 20px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 50%;
            max-width: 400px;
            box-sizing: border-box;
        }
        table {
            width: 80%;
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
    </style>
</head>
<body>
    <h1>Results by Individual Polling Unit</h1>

    <select id="pollingUnitSelect">
        <option value="">Select Polling Unit</option>
        @foreach ($lgas as $lga)
            <option value="{{ $lga->polling_unit_uniqueid }}">UniqueID-{{ $lga->polling_unit_uniqueid }} : LGAID{{ $lga->lga_id }}</option>
        @endforeach
    </select>

    <h1>Polling Unit Result Sum</h1>

    <table id="resultTable">
        <thead>
            <tr>
                <th>PU Unique ID</th>
                <th>LGA ID</th>
                <th>Total Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lgas as $lga)
            <tr data-uniqueid="{{ $lga->polling_unit_uniqueid }}">
                <td>{{ $lga->polling_unit_uniqueid }}</td>
                <td>{{ $lga->lga_id }}</td>
                <td>{{ $lga->total_score }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.getElementById('pollingUnitSelect').addEventListener('change', function() {
            var selectedUniqueId = this.value;
            if (selectedUniqueId) {
                window.location.href = '/polling-unit/' + selectedUniqueId;
            }
        });
    </script>
</body>
</html>
