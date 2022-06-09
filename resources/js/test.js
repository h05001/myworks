import 'chart.js';

window.make_chart = function make_chart(id, labels, data)
{
   var ctx = document.getElementById(id).getContext('2d');
   var myChart = new Chart(ctx, {
       //type: 'pie',
       type: 'line',
       data: {
           labels: labels,
           datasets: [{
               label: '価格変動歴',
               data: data,
               borderColor: 'rgba(255, 100, 100, 1)',

               lineTension: 0,
               fill: false,
               borderWidth: 3

           }]
       },
       options: {
          responsive: false,
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          scales: {
              xAxes: [{
                  scaleLabel: {
                      display: true,
                      labelString: '日付',
                      fontSize: 14                  // フォントサイズ
                  },

                  gridLines: {                   // 補助線
                      display: true,
                      color: "rgba(255, 0, 0, 0.2)", // 補助線の色
                  }
              }],
              yAxes: [{

                  scaleLabel: {
                    　display: true,
                    　labelString: '価格',
                      fontSize: 14                  // フォントサイズ
                  },
                  gridLines: {                   // 補助線
                      display: true,
                      color: "rgba(255, 0, 0, 0.2)", // 補助線の色
                  },
              }]
          },
       }
   });
};
//backgroundColor: [
//    'rgba(255, 99, 132, 0.2)',
//    'rgba(54, 162, 235, 0.2)',
//    'rgba(255, 206, 86, 0.2)',
//    'rgba(75, 192, 192, 0.2)',
//    'rgba(153, 102, 255, 0.2)',
//    'rgba(255, 159, 64, 0.2)'
//],
//borderColor: [
//    'rgba(255, 99, 132, 1)',
//  'rgba(54, 162, 235, 1)',
//    'rgba(255, 206, 86, 1)',
//    'rgba(75, 192, 192, 1)',
//    'rgba(153, 102, 255, 1)',
//    'rgba(255, 159, 64, 1)'
//],
//borderWidth: 1
