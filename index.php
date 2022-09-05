<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>server side datatable by guddu</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID </th>
                <th>NAME</th>
                <th>URL</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID </th>
                <th>NAME</th>
                <th>URL</th>
            </tr>
        </tfoot>
    </table>






    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url:'getdata.php',
                    type:"POST",
                    error:function(err){
                        console.log(err);
                    }
                }
            });
        });
    </script>
</body>

</html>
