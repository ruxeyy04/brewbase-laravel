$.ajax({
    type: "GET",
    url: url + "api/homepage.php",
    dataType: "json",
    success: function (res) {
        $('.totalProduct').text(res.totalProducts)
        $('.totalCustomer').text(res.totalCustomers)
        $('.totalRevenue').text(res.totalRevenue)
        $('.totalOrder').text(res.totalOrders)
    }
});

$('#dashboard-users').DataTable({
    ajax: {
        url: url+'api/customerlist.php',
        dataSrc: 'data'
    },
    columns: [
        { data: '0' },
        { data: '1',width: "150px" },
        { data: '2' },
        { data: '3' },
        { data: '4' },
        { data: '5' },
        { data: '6' }
    ]
});