<script>
    $(document).ready(function() {
        let perPageSelector = $('#perPage');
        let globalSearch = $('#globalSearch');
        let recordsTable = $('.records-table');
        let recordsLoader = $('.records-loader');
        let page = new URLSearchParams(window.location.search).get('page') || 1;
        let totalRecordsElements = $('#totalRecordsElement');
        let records_prefix = '{{ $records_prefix }}';
        let dataTable = $('#'+ records_prefix +'-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: {
                url: '{!! route($records_prefix . ".data") !!}',  // Make sure route is correctly defined
                data: function(d) {
                    d.length = perPageSelector.val();
                    d.search = globalSearch.val();
                    d.page = page;
                }
            },
            columns: @json($columns),  // Ensure columns are properly passed as JSON
            search: false,
            paging: false,  // Enable default pagination controls
            dom: 'lrtip', // Default DataTable controls (length, filter, table, info, pagination)
            drawCallback: function(response) {
                recordsLoader.hide();
                console.log(response.json);
                totalRecordsElements.text(response.json.recordsTotal);
            }
        });

        // Show loader inside table when processing starts
        dataTable.on('processing.dt', function(e, settings, processing) {
            if (processing) {
                recordsTable.hide();
                recordsLoader.show();
            } else {
                recordsTable.show();
                recordsLoader.hide();
            }
        });

        // Handle Per Page Dropdown Change
        $('#perPage').change(function() {
            dataTable.ajax.reload(); // Reload DataTable with new per-page value
        });

        // Handle Global Search Input
        $('#globalSearch').keyup(function() {
            dataTable.ajax.reload(); // Reload DataTable with new search value
        });

        // Update the page parameter when navigating between pages
        dataTable.on('page.dt', function() {
            var info = dataTable.page.info();
            page = info.page + 1; // Set current page number from DataTable info
        });
    });
</script>
