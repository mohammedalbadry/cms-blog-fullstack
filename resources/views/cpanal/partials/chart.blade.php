<!-- ChartJS -->
<script src="{{asset('/cpanal/plugins/chart.js/Chart.min.js')}}"></script>
<script>
  var ctx = document.getElementById('revenue-chart-canvas').getContext('2d');
   ctx.rtl = true;
   ctx.canvas.originalwidth = ctx.canvas.width;
   ctx.canvas.originalheight = ctx.canvas.height;
   var visitos_days = {!! json_encode($visitos_days) !!}; 
   var visitos_views = {!! json_encode($visitos_views) !!}; 
   //data
   var chartData = {
       labels: visitos_days,
       datasets: [
             {
               label               : 'Digital Goods',
               backgroundColor     : 'rgba(60,141,188,0.9)',
               borderColor         : 'rgba(60,141,188,0.8)',
               pointRadius          : false,
               pointColor          : '#3b8bba',
               pointStrokeColor    : 'rgba(60,141,188,1)',
               pointHighlightFill  : '#fff',
               pointHighlightStroke: 'rgba(60,141,188,1)',
               data                : visitos_views
             }
       ]
   }
   //options
   var chartOptions = {
       maintainAspectRatio : false,
       responsive : true,
       legend: {
         display: false,
       },
       scales: {
         myScale: {
           type: 'logarithmic',
           position: 'right', // `axis` is determined by the position as `'y'`
         }
       }
     }
     
   var myChart = new Chart(ctx, {
       type: "line",
       data: chartData,
       options: chartOptions
   });
 
 </script>