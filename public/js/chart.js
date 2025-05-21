function makeChart(id, color) {
    var ctx = document.getElementById(id).getContext("2d");

    // Create Linear Gradient
    var blue_trans_gradient = ctx.createLinearGradient(
        0,
        0,
        0,
        ctx.canvas.height
    );
    blue_trans_gradient.addColorStop(0, color);
    blue_trans_gradient.addColorStop(1, "rgba(255,255,255,0)");

    // Chart Options
    var chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        elements: {
            line: {
                borderWidth: 1.5,
                borderColor: color,
                backgroundColor: blue_trans_gradient,
                fill: true,
                tension: 0.4, // This will make the line smooth (curved)
            },
            point: {
                radius: 0,
            },
        },
        plugins: {
            legend: {
                display: false,
            },
            tooltip: {
                enabled: false, // Disable tooltips
            },
        },
        scales: {
            x: {
                display: false,
            },
            y: {
                display: false,
                min: 0,
                max: 85,
            },
        },
    };

    // Chart Data
    var chartData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        datasets: [
            {
                label: "BTC",
                data: [20, 18, 35, 60, 38, 40, 70],
            },
        ],
    };

    var config = {
        type: "line",
        data: chartData,
        options: chartOptions,
    };

    // Create the chart
    var myChart = new Chart(ctx, config);
}

makeChart("chartjs1", "green");
makeChart("chartjs2", "white");
makeChart("chartjs3", "skyblue");
makeChart("chartjs4", "orange");
