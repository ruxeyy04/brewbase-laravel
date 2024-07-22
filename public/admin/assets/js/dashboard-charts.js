// var url = "https://brewbase.logiclynxz.com/brewbase-staff/admin/"
var trafficchart = document.getElementById("trafficflow");
var saleschart = document.getElementById("sales");

// Fetch revenue data from the database using AJAX
$.ajax({
  url: 'http://127.0.0.1:8000/api/admin/getRevenueData',
  method: 'GET',
  dataType: 'json',
  success: function (revenueData) {
    // Create an array to hold revenue data
    var revenue = [];

    // Iterate through the revenue data and extract the amount for each month
    for (var i = 0; i < revenueData.length; i++) {
      revenue[revenueData[i].month - 1] = revenueData[i].amount;
    }

    // Fill missing months with 0
    var currentMonth = new Date().getMonth() + 1;
    for (var i = 1; i <= 12; i++) {
      if (i > currentMonth || typeof revenue[i - 1] === 'undefined') {
        revenue[i - 1] = 0;
      }
    }

    // Map month numbers to month names
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Create the revenue chart
    var myChart1 = new Chart(trafficchart, {
      type: 'line',
      data: {
        labels: months.slice(0, currentMonth),
        datasets: [{
          data: revenue.slice(0, currentMonth),
          backgroundColor: "rgba(48, 164, 255, 0.2)",
          borderColor: "rgba(48, 164, 255, 0.8)",
          fill: true,
          borderWidth: 1
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
            position: 'right',
          },
          title: {
            display: true,
            text: 'Revenue Overview',
            position: 'left',
          },
        },
      }
    });
  }
});

// Fetch number of orders data from the database using AJAX
$.ajax({
  url:'http://127.0.0.1:8000/api/admin/getOrderData',
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
