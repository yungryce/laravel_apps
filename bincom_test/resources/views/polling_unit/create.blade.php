<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Polling Unit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
            text-align: center;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <div class="container">
        <h1>Create Results for New Polling Unit</h1>

        <form action="{{ route('polling-unit.store') }}" method="post">
            @csrf

            <label for="polling_unit_uniqueid">Polling Unit Unique ID:</label>
            <input type="text" id="polling_unit_uniqueid" name="polling_unit_uniqueid" value="{{ $nextUniqueId }}" required>

            <label for="parties">Party Results:</label>
            @foreach ($parties as $party)
                <div>
                    <label for="party_{{ $party->id }}">{{ $party->partyname }}</label>
                    <input type="number" id="party_{{ $party->id }}" name="party[{{ $party->id }}][party_score]" min="0" required>
                    <!-- Ensure that each party input field is named as party[party_id][party_score] -->
                </div>
            @endforeach

            <button type="submit">Submit</button>
        </form>

    </div>
</body>
</html>
