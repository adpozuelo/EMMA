/* globals Chart:false, feather:false */

(function () {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  var temp = document.getElementById('tempChart')
  var hum = document.getElementById('humChart')

  // eslint-disable-next-line no-unused-vars
  var tempChart = new Chart(temp, {
    type: 'line',
    data: {
      labels: dates,
      datasets: [{
        data: temperature,
        label: 'Temperatura',
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: 'blue',
        borderWidth: 4,
        pointBackgroundColor: 'yellow'
      },{
        data: w_temperature,
        label: 'Temperatura aviso',
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: 'orange',
        borderWidth: 4,
        pointBackgroundColor: 'yellow',
        pointRadius: 0,
      },{
        data: c_temperature,
        label: 'Temperatura crítica',
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: 'red',
        borderWidth: 4,
        pointBackgroundColor: 'yellow',
        pointRadius: 0,
      }]
    },
    options: {
      scales: {
        yAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Grados Celsius'
          },
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: true
      }
    }
  })

  var humChart = new Chart(hum, {
    type: 'line',
    data: {
      labels: dates,
      datasets: [{
        data: humidity,
        label: 'Humedad',
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: 'blue',
        borderWidth: 4,
        pointBackgroundColor: 'yellow'
      },{
        data: w_humidity,
        label: 'Humedad aviso',
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: 'orange',
        borderWidth: 4,
        pointBackgroundColor: 'yellow',
        pointRadius: 0
      },{
        data: c_humidity,
        label: 'Humedad crítica',
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: 'red',
        borderWidth: 4,
        pointBackgroundColor: 'yellow',
        pointRadius: 0,
      }]
    },
    options: {
      scales: {
        yAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Porcentaje (%)'
          },
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: true
      }
    }
  })
})()
