<!DOCTYPE html>
<html>
<head>
    <title>Export Data to Excel Sheet </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;
            border:1px solid #ccc;
        }
    </style>
</head>
<body>
<br />
<div class="container">
    <h3 align="center">Download File in Excel Sheet</h3><br />
    <a href="{{ URL::to( $path)  }}" target="_blank">{{ $path }}</a>
    <br />
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <td>filepath</td>


            </tr>
            @foreach($data as $row)
                <tr>
                    <td>{{ $row->filepath }}</td>

                </tr>
            @endforeach
        </table>
    </div>

</div>
</body>
</html>
