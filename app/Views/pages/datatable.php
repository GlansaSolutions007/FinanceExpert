<!doctype html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>   
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
        <script>
//         $(document).ready(function () {
//     $('#datatable').DataTable();
// });

    </script>
    <script>
        function bodyload()
        {
            $.ajax({
    method: 'get', // HTTP request method (GET in this case)
    url: 'https://fakestoreapi.com/products', // URL to send the request to
    success: function(response) {
        console.log(response);
        updateTable(response);
    },
    error: function(xhr, status, error) {
        // Code to handle errors if the request fails
        console.error(error);
    }
});
        }
    function updateTable(data) {
    var tableBody = $('#datatable tbody');
    tableBody.empty(); // Clear the existing table content

    if (data.length > 0) {
        $.each(data, function(index, row) {
            var newRow = $('<tr>');
            newRow.append('<td>' + (index + 1) + '</td>');
            newRow.append('<td>' + (row.title) + '</td>');
            newRow.append('<td>' + (row.price) + '</td>');
            newRow.append('<td>' + (row.category) + '</td>');
            newRow.append('<td>' + (row.image) + '</td>');
            newRow.append('<td>' + (row.rating.rate) + '</td>');

            // Append the new row to the table body
            tableBody.append(newRow);
        });
    } else {
        console.log("No data found."); // Add this for debugging
    }

    // Inform DataTables that the table has been updated
    var dataTable = $('#datatable').DataTable();
    dataTable.rows().invalidate().draw();
}



    </script>
    </head>
    
    <body class="m-2 p-2" onload="bodyload()">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <th>Sr no</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Ratings</th>
            </thead>
            <tbody id="datatable tbody">
                
            </tbody>
        </table>
    </body>
</html>