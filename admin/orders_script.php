
<script>
var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[3]);

        if (min === null && max === null) {
            return true;
        }else if(min <= date && date <= max) {
            return true;
        }
        return false;
    }
);


minDate = new DateTime($('#return_min'), {
    format: "YYYY-MM-DD"
});
maxDate = new DateTime($('#return_max'), {
    format: "YYYY-MM-DD"
});





return_datatable = $('#return_table').DataTable({

    dom: 'Bfrtip',
    buttons: [
        'excel', 'pdf', 'print',
        {
            extend: 'colvis',
            collectionLayout: 'fixed columns',
            collectionTitle: 'Column visibility control'
        }
    ],
    // drawCallback: function() {
    //     var api = this.api();
    //     var sum = 0;
    //     var formated = 0;
    //     //to show first th
    //     $(api.column(4).footer()).html('Total');


    //     sum = api.column(5, {
    //         page: 'current'
    //     }).data().sum();

    //     //to format this sum
    //     formated = parseFloat(sum).toLocaleString(undefined, {
    //         minimumFractionDigits: 2
    //     });
    //     $(api.column(5).footer()).html('P ' + formated);


    // }
});
$('#filter_reason').on('change', function() {
    var tosearch = '' + this.value + '';
    return_datatable.search(tosearch).draw();
});

$('#return_min, #return_max').on('change', function() {
    return_datatable.draw();
});

$('#clear-date-filter').on('click', function() {
    $('#return_min').val("");
    $('#return_max').val("");
    return_datatable.draw();
});
</script>