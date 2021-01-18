<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Asumbrado | Realty Services</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 1000px;
          margin-left: auto;
          margin-right: auto;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 2px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
    </style>
</head>
<body>
    <div class="text-center mb-5 mx-auto" style="width: 500px">
        <p class="text-2xl font-bold">Asumbrado Realty Services</p>
    </div>
    <div class="text-center mb-5">
        <p class="font-bold">Transaction Report as of {{$date}}</p>
    </div>
    <div>
        <table>
            <tr>
              <th>Buyer</th>
              <th>Lot</th>
              <th>OR No.</th>
              <th>Amount</th>
              <th>Total Recievable</th>
              <th>Remaining Balance</th>
            </tr>
            <?php $totalPaid = 0 ?>
            @foreach ($datas as $data)
                <tr>
                    <td><b>{{ $data->applicant->name }}</b></td>
                    <td><b>{{ $data->lot->name }}</b> Block: {{ $data->lot->block_no }} Lot: {{ $data->lot->lot_no }} Area: {{ $data->lot->area }}sqm</td>
                    <td>{{ $data->or_number }}</td>
                    <td>₱ {{ ($data->amount) }}</td>
                    <td>₱ {{ ($data->total_recievable) }}</td>
                    <td>₱ {{ ($data->balance) }}</td>
                </tr>
            <?php $totalPaid = ($data->amount) + $totalPaid ?>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td><b>Total Paid:</b></td>
                <td>₱ {{ $totalPaid }}</td>
                <td></td>
            </tr>
        </table>
    </div>
</body>
</html>