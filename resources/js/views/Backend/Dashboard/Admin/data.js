const patientChart = {
    chart: {
        height: 230,
        type: "bar",
        stacked: true,
        toolbar: {
            show: false,
        },
        dataLabels: {
            enabled: false,
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
                "Oct",
                "Nov",
                "Dec",
            ],
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
                columnWidth: "15%",
            },
        },
    },
    series: [
        {
            name: "Male",
            color: "#2E37A4",
            data: [20, 30, 41, 67, 22, 43, 40, 10, 30, 20, 40],
        },
        {
            name: "Female",
            color: "#00D3C7",
            data: [13, 23, 20, 8, 13, 27, 30, 25, 10, 15, 20],
        },
    ],
};

const donutChart = {
    chart: {
        height: 290,
        type: "donut",
        toolbar: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "50%",
        },
    },
    series: [44, 55, 41, 17],
    labels: ["Neurology", "Dental Care", "Gynocology", "Orthopedic"],
    responsive: [
        {
            breakpoint: 480,
            options: {
                chart: {
                    width: 200,
                },
                legend: {
                    position: "bottom",
                },
            },
        },
    ],
    legend: {
        position: "bottom",
    },
};

export { patientChart, donutChart };
