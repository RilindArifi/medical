const healthChart = {
    chart: {
        height: 170,
        type: "line",
        toolbar: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
        },
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Nov",
                "Dec",
            ],
        },
    },
    series: [
        {
            name: "Health",
            color: "#00D3C7",
            data: [20, 40, 85, 25, 50, 30, 50, 20, 50, 40, 30, 20],
        },
    ],
};

const heartRate = {
    chart: {
        height: 200,
        type: "line",
        toolbar: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
        },
        xaxis: {
            categories: ["0", "1", "2", "3", "4", "5", "6"],
        },
    },
    series: [
        {
            name: "Health",
            color: "#FF3667",
            data: [20, 20, 85, 35, 60, 30, 20],
        },
    ],
};

const sColStacked = {
    chart: {
        height: 230,
        type: "bar",
        stacked: false,
        toolbar: {
            show: false,
        },
        xaxis: {
            categories: ["1", "10", "20", "30", "40", "50", "60"],
        },
        dataLabels: {
            enabled: false,
        },
        responsive: [
            {
                breakpoint: 480,
                options: {
                    legend: {
                        position: "bottom",
                        offsetX: -10,
                        offsetY: 0,
                    },
                },
            },
        ],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "90%",
            },
        },

        stroke: {
            show: true,
            width: 6,
            colors: ["transparent"],
        },
    },
    // colors: ['#4361ee', '#888ea8', '#e3e4eb', '#d3d3d3'],
    series: [
        {
            name: "Low",
            color: "#D5D7ED",
            data: [10, 30, 10, 30, 10, 30, 30],
        },
        {
            name: "High",
            color: "#2E37A4",
            data: [20, 20, 20, 20, 20, 20, 20],
        },
    ],
};

const sCol = {
    chart: {
        height: 220,
        type: "bar",
        stacked: true,
        toolbar: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "30%",
                endingShape: "rounded",
            },
        },
        stroke: {
            show: true,
            width: 1,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands";
                },
            },
        },
    },
    series: [
        {
            name: "High",
            color: "#2E37A4",
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
        },
        {
            name: "Low",
            color: "rgba(46, 55, 164, 0.05)",
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
        },
    ],
};

const sleepChart = {
    chart: {
        height: 200,
        type: "line",
        toolbar: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
        },
        xaxis: {
            categories: ["0", "1", "2", "3", "4", "5", "6"],
        },
    },
    series: [
        {
            name: "Sleep",
            color: "#2E37A4",
            data: [20, 21, 20, 21, 20, 21, 22],
        },
    ],
};

export { healthChart, heartRate, sColStacked, sCol, sleepChart };
