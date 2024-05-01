$(document).ready(function () {
  // Get all tab link elements
  var tabLinks = $('.tab-link');

  // Click event handler for tab links
  tabLinks.click(function () {
      // Remove 'active' class from all tab link elements
      tabLinks.removeClass('active');
      
      // Add 'active' class to the clicked tab link
      $(this).addClass('active');
      
      // Hide all tab content elements
      $('.tab-content').hide();
      
      // Show the corresponding tab content based on the data-tab attribute of the clicked tab link
      $('#' + $(this).data('tab')).show();
      
      // Save the index of the clicked tab link with the 'active' class into localStorage
      localStorage.setItem('activeTabIndex', tabLinks.index($(this)));
  });

  // Retrieve the index of the previously active tab link from localStorage
  var activeTabIndex = localStorage.getItem('activeTabIndex');

  // If there's a previously active tab link index, trigger a click event on it
  if (activeTabIndex !== null) {
      tabLinks.eq(activeTabIndex).click();
  } else {
      // If no tab was previously active, click the first tab link
      tabLinks.first().click();
  }
});


  

  // Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var categoryInputs = document.querySelectorAll('.category');

  // Initialize arrays to store category IDs and total products
  var categories = [];
  var totalProducts = [];

  // Loop through each hidden input element
  categoryInputs.forEach(function(input) {
      // Retrieve data attributes from the input element
      var categoryId = input.getAttribute('data-category');
      var products = input.getAttribute('data-total-products');

      // Push data into respective arrays
      categories.push(categoryId);
      totalProducts.push(parseInt(products)); // Convert to integer
  });

  // Initialize the data array with the header
  var data = [['Category', 'From total stock']];

  // Loop through the categories and totalProducts arrays to populate the data array
  for (var i = 0; i < categories.length; i++) {
      // Push each category and its corresponding total products into the data array
      data.push([categories[i], totalProducts[i]]);
  }

  // Convert the data array into a DataTable object
  var dataTable = google.visualization.arrayToDataTable(data);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Items in Stock', backgroundColor: '#dbe4ec'};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(dataTable, options);
}




google.charts.setOnLoadCallback(drawChart2);

function drawChart2() {
// Set Data
var data = google.visualization.arrayToDataTable([
  ['Date', 'Price'],
  [5,180],[10,500],[15,460],[20,0],[25,700],
  [30,500]
]);
// Set Options
var options2 = {
  title: 'Daily Profit',
  hAxis: {title: 'Date in February'},
  vAxis: {title: 'Profit(tk)'},
  legend: 'none',
  backgroundColor: '#dbe4ec'
};
// Draw
var chart = new google.visualization.LineChart(document.getElementById('myChart'));
chart.draw(data, options2);
}

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
  $('.select2').select2();
});
