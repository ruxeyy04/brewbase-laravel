var trafficchart = document.getElementById("trafficflow");
var saleschart = document.getElementById("sales");

// Fetch revenue data from the database using AJAX


// Fetch number of orders data from the database using AJAX
$.ajax({
  url: 'https://brewbase.logiclynxz.com/brewbase-staff/incharge/api/order.php',
  method: 'GET',
  dataType: 'json',
  success: function (ordersData) {
    // Create an array to hold the number of orders data
    var orders = [];

    // Iterate through the orders data and extract the count for each month
    for (var i = 0; i < ordersData.length; i++) {
      orders[ordersData[i].month - 1] = ordersData[i].count;
    }

    // Fill missing months with 0
    var currentMonth = new Date().getMonth() + 1;
    for (var i = 1; i <= 12; i++) {
      if (i > currentMonth || typeof orders[i - 1] === 'undefined') {
        orders[i - 1] = 0;
      }
    }

    // Map month numbers to month names
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Create the number of orders chart
    var myChart2 = new Chart(saleschart, {
      type: 'bar',
      data: {
        labels: months.slice(0, currentMonth),
        datasets: [{
          label: 'Orders',
          data: orders.slice(0, currentMonth),
          backgroundColor: "rgba(76, 175, 80, 0.5)",
          borderColor: "#6da252",
          borderWidth: 1,
        }]
      },
      options: {
        animation: {
          duration: 2000,
          easing: 'easeOutQuart',
        },
        plugins: {
          legend: {
            display: false,
            position: 'top',
          },
          title: {
            display: true,
            text: 'Number of Orders',
            position: 'left',
          },
        },
      }
    });
  }
});
