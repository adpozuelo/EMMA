/* globals Chart:false, feather:false */

(function () {
  "use strict";

  feather.replace({ "aria-hidden": "true" });

  var mem = document.getElementById("mem");
  var fs = document.getElementById("fs");
  var varfs = document.getElementById("var");
  var scratch = document.getElementById("scratch");
  var loadChart = document.getElementById("loadChart");

  new Chart(mem, {
    type: "pie",
    data: {
      labels: ["Ocupada", "Libre"],
      datasets: [
        {
          backgroundColor: ["red", "green"],
          data: memory,
        },
      ],
    },
    options: {
      legend: {
        display: false,
      },
      title: {
        display: true,
        text: "Memoria GiB",
      },
    },
  });

  new Chart(fs, {
    type: "pie",
    data: {
      labels: ["Ocupado", "Libre"],
      datasets: [
        {
          backgroundColor: ["red", "green"],
          data: fs_usage,
        },
      ],
    },
    options: {
      legend: {
        display: false,
      },
      title: {
        display: true,
        text: "/ en %",
      },
    },
  });

  new Chart(varfs, {
    type: "pie",
    data: {
      labels: ["Ocupado", "Libre"],
      datasets: [
        {
          label: "/var en %",
          backgroundColor: ["red", "green"],
          data: var_usage,
        },
      ],
    },
    options: {
      legend: {
        display: false,
      },
      title: {
        display: true,
        text: "/var en %",
      },
    },
  });

  new Chart(scratch, {
    type: "pie",
    data: {
      labels: ["Ocupado", "Libre"],
      datasets: [
        {
          backgroundColor: ["red", "green"],
          data: scratch_usage,
        },
      ],
    },
    options: {
      legend: {
        display: false,
      },
      title: {
        display: true,
        text: "/scratch en %",
      },
    },
  });

  var loadChart = new Chart(loadChart, {
    type: "line",
    data: {
      labels: dates,
      datasets: [
        {
          data: load,
          label: "Carga CPU",
          lineTension: 0,
          backgroundColor: "transparent",
          borderColor: "blue",
          borderWidth: 4,
          pointBackgroundColor: "yellow",
        },
      ],
    },
    options: {
      scales: {
        yAxes: [
          {
            scaleLabel: {
              display: true,
              labelString: "%",
            },
            ticks: {
              beginAtZero: false,
            },
          },
        ],
      },
      legend: {
        display: true,
      },
    },
  });

  var gpumem0 = document.getElementById("gpumem0");
  var gpu_load0 = document.getElementById("gpuload0");

  if (gpumem0 && gpu_load0) {
    new Chart(gpumem0, {
      type: "pie",
      data: {
        labels: ["Ocupada", "Libre"],
        datasets: [
          {
            backgroundColor: ["red", "green"],
            data: gpumemory[0],
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: "Memoria GiB",
        },
      },
    });

    new Chart(gpu_load0, {
      type: "line",
      data: {
        labels: dates,
        datasets: [
          {
            data: gpuload[0],
            label: "Carga GPU",
            lineTension: 0,
            backgroundColor: "transparent",
            borderColor: "blue",
            borderWidth: 4,
            pointBackgroundColor: "yellow",
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              scaleLabel: {
                display: true,
                labelString: "%",
              },
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
        legend: {
          display: true,
        },
      },
    });
  }

  var gpumem1 = document.getElementById("gpumem1");
  var gpu_load1 = document.getElementById("gpuload1");

  if (gpumem1 && gpu_load1) {
    new Chart(gpumem1, {
      type: "pie",
      data: {
        labels: ["Ocupada", "Libre"],
        datasets: [
          {
            backgroundColor: ["red", "green"],
            data: gpumemory[1],
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: "Memoria GiB",
        },
      },
    });

    new Chart(gpu_load1, {
      type: "line",
      data: {
        labels: dates,
        datasets: [
          {
            data: gpuload[1],
            label: "Carga GPU",
            lineTension: 0,
            backgroundColor: "transparent",
            borderColor: "blue",
            borderWidth: 4,
            pointBackgroundColor: "yellow",
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              scaleLabel: {
                display: true,
                labelString: "%",
              },
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
        legend: {
          display: true,
        },
      },
    });
  }

  var gpumem2 = document.getElementById("gpumem2");
  var gpu_load2 = document.getElementById("gpuload2");

  if (gpumem2 && gpu_load2) {
    new Chart(gpumem2, {
      type: "pie",
      data: {
        labels: ["Ocupada", "Libre"],
        datasets: [
          {
            backgroundColor: ["red", "green"],
            data: gpumemory[2],
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: "Memoria GiB",
        },
      },
    });

    new Chart(gpu_load2, {
      type: "line",
      data: {
        labels: dates,
        datasets: [
          {
            data: gpuload[2],
            label: "Carga GPU",
            lineTension: 0,
            backgroundColor: "transparent",
            borderColor: "blue",
            borderWidth: 4,
            pointBackgroundColor: "yellow",
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              scaleLabel: {
                display: true,
                labelString: "%",
              },
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
        legend: {
          display: true,
        },
      },
    });
  }

  var gpumem3 = document.getElementById("gpumem3");
  var gpu_load3 = document.getElementById("gpuload3");

  if (gpumem3 && gpu_load3) {
    new Chart(gpumem3, {
      type: "pie",
      data: {
        labels: ["Ocupada", "Libre"],
        datasets: [
          {
            backgroundColor: ["red", "green"],
            data: gpumemory[3],
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: "Memoria GiB",
        },
      },
    });

    new Chart(gpu_load3, {
      type: "line",
      data: {
        labels: dates,
        datasets: [
          {
            data: gpuload[3],
            label: "Carga GPU",
            lineTension: 0,
            backgroundColor: "transparent",
            borderColor: "blue",
            borderWidth: 4,
            pointBackgroundColor: "yellow",
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              scaleLabel: {
                display: true,
                labelString: "%",
              },
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
        legend: {
          display: true,
        },
      },
    });
  }

  var gpumem4 = document.getElementById("gpumem4");
  var gpu_load4 = document.getElementById("gpuload4");

  if (gpumem4 && gpu_load4) {
    new Chart(gpumem4, {
      type: "pie",
      data: {
        labels: ["Ocupada", "Libre"],
        datasets: [
          {
            backgroundColor: ["red", "green"],
            data: gpumemory[4],
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: "Memoria GiB",
        },
      },
    });

    new Chart(gpu_load4, {
      type: "line",
      data: {
        labels: dates,
        datasets: [
          {
            data: gpuload[4],
            label: "Carga GPU",
            lineTension: 0,
            backgroundColor: "transparent",
            borderColor: "blue",
            borderWidth: 4,
            pointBackgroundColor: "yellow",
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              scaleLabel: {
                display: true,
                labelString: "%",
              },
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
        legend: {
          display: true,
        },
      },
    });
  }

  var gpumem5 = document.getElementById("gpumem5");
  var gpu_load5 = document.getElementById("gpuload5");

  if (gpumem5 && gpu_load5) {
    new Chart(gpumem5, {
      type: "pie",
      data: {
        labels: ["Ocupada", "Libre"],
        datasets: [
          {
            backgroundColor: ["red", "green"],
            data: gpumemory[5],
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: "Memoria GiB",
        },
      },
    });

    new Chart(gpu_load5, {
      type: "line",
      data: {
        labels: dates,
        datasets: [
          {
            data: gpuload[5],
            label: "Carga GPU",
            lineTension: 0,
            backgroundColor: "transparent",
            borderColor: "blue",
            borderWidth: 4,
            pointBackgroundColor: "yellow",
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              scaleLabel: {
                display: true,
                labelString: "%",
              },
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
        legend: {
          display: true,
        },
      },
    });
  }

  var gpumem6 = document.getElementById("gpumem6");
  var gpu_load6 = document.getElementById("gpuload6");

  if (gpumem6 && gpu_load6) {
    new Chart(gpumem6, {
      type: "pie",
      data: {
        labels: ["Ocupada", "Libre"],
        datasets: [
          {
            backgroundColor: ["red", "green"],
            data: gpumemory[6],
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: "Memoria GiB",
        },
      },
    });

    new Chart(gpu_load6, {
      type: "line",
      data: {
        labels: dates,
        datasets: [
          {
            data: gpuload[6],
            label: "Carga GPU",
            lineTension: 0,
            backgroundColor: "transparent",
            borderColor: "blue",
            borderWidth: 4,
            pointBackgroundColor: "yellow",
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              scaleLabel: {
                display: true,
                labelString: "%",
              },
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
        legend: {
          display: true,
        },
      },
    });
  }

  var gpumem7 = document.getElementById("gpumem7");
  var gpu_load7 = document.getElementById("gpuload7");

  if (gpumem7 && gpu_load7) {
    new Chart(gpumem7, {
      type: "pie",
      data: {
        labels: ["Ocupada", "Libre"],
        datasets: [
          {
            backgroundColor: ["red", "green"],
            data: gpumemory[7],
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          text: "Memoria GiB",
        },
      },
    });

    new Chart(gpu_load7, {
      type: "line",
      data: {
        labels: dates,
        datasets: [
          {
            data: gpuload[7],
            label: "Carga GPU",
            lineTension: 0,
            backgroundColor: "transparent",
            borderColor: "blue",
            borderWidth: 4,
            pointBackgroundColor: "yellow",
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              scaleLabel: {
                display: true,
                labelString: "%",
              },
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
        legend: {
          display: true,
        },
      },
    });
  }

})();
