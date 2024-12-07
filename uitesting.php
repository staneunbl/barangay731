<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Display</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <style>
        /* Add some styling for the logo */
        #tableHeaderLogo {
            width: 100px; /* Adjust width as needed */
            height: auto; /* Adjust height as needed */
        }
    </style>
</head>
<body>
    <!-- Display the logo above the table -->
    <img id="tableHeaderLogo" src="logo.png" alt="Logo">

    <table id="logTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Message</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            <!-- Log entries will be inserted here dynamically -->
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            // Sample log data
            var logs = [
                { date: "2024-04-24 08:00:00", message: "Error: Database connection failed", level: "Error" },
                { date: "2024-04-24 09:15:00", message: "Warning: Disk space low", level: "Warning" },
                { date: "2024-04-24 10:30:00", message: "Info: Application started", level: "Info" }
            ];

            // Populate the table with log data
            var table = $('#logTable').DataTable({
                data: logs,
                columns: [
                    { data: 'date' },
                    { data: 'message' },
                    { data: 'level' }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        customize: function(doc) {
                            // Add temporary logo to PDF
                            var logo = new Image();
                            logo.src = 'https://via.placeholder.com/100';
                            doc.content.splice(0, 0, {
                                image: logo.src,
                                width: 100, // Adjust width as needed
                                alignment: 'center'
                            });
                        }
                    },
                    'copy',
                    'csv',
                    'excel',
                    {
                        extend: 'print',
                        customize: function(win) {
                            // Add temporary logo to printed document
                            $(win.document.body).prepend('<img src="https://via.placeholder.com/100" style="position:absolute;top:0;left:0;">');
                        }
                    }
                ]
            });
        });
    </script>
</body>
</html>
