


    // DataTables initialization
    var table = $('#transactions').DataTable({
        ajax: {
            url: url+'api/admin/getTransactions',
            dataSrc: 'data'
        },
        columns: [
            { data: 'payment_id' },
            { data: 'customer_name', },
            { data: 'payment_method' },
            { data: 'order_id' },
            { data: 'status' },
            { data: 'payment_date' },
            { data: 'amount' }
        ],
        order: []
    });
  
  
