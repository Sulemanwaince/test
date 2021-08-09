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
   <h3 align="center">Export Data to Excel Sheet</h3><br />
   <div align="center">
    <a href="{{ route('export_excel.excel') }}" type="file" name="file" class="btn btn-success">Export to Excel</a>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <tr>
      <td>variant</td>
      <td>stock</td>

     </tr>
     @foreach($data as $row)
     <tr>
      <td>{{ $row->variant }}</td>
      <td>{{ $row->stock }}</td>

     </tr>
     @endforeach
    </table>
   </div>

  </div>
 </body>
</html>
