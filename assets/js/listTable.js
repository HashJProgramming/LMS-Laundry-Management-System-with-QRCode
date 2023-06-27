$(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Blfrtip',
        buttons: [
            { extend: 'excel', className: 'btn btn-primary' },
            { extend: 'pdf', className: 'btn btn-primary' },
            { extend: 'print', className: 'btn btn-primary' }
        ]
    } );
    
    
} );