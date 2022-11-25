<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            font-family: sans-serif;
        }

        .page-break {
            page-break-after: always;
        }

        .table1 {
            color: #232323;
            border-collapse: collapse;
            width: 100%;
        }

        .table1,
        th,
        td {
            border: 1px solid #999;
            padding: 7px 5px;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div>
        <span>REKAP SURAT KONTRAK</span>
        <hr>
        <table class="table1">
            <thead style="font-size: 0.80rem; ">
                <tr>
                    <td>No</td>
                    <td>Nomor Surat</td>
                    <td>File</td>
                    <td>Tanggal</td>
                </tr>
            </thead>
            <tbody style=" font-size: 0.70rem;">
                @foreach ($surat as $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $value->no_surat }}</td>
                    <td>{{ $value->file }}</td>
                    <td>{{ $value->tgl }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/php">if (isset($pdf)) {
            $x = 350;
            $y = 570;
            $text = "Page {PAGE_NUM} of {PAGE_COUNT} [ Apsi ]";
            $font = null;
            $size = 7;
            $color = array(255,0,0);
            $word_space = 0.0; 
            $char_space = 0.0; 
            $angle = 0.0;  
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }</script>
</body>

</html>