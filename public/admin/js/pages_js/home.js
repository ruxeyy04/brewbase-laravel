
$('#dashboard-users').DataTable({
    ajax: {
        url: url+'api/admin/customerlist',
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