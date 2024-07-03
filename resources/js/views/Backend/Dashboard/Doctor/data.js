const areaChart = {
    chart: {
        height: 200,
        type: "line",
        toolbar: {
            show: false
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: "smooth"
        },
    },
    
    series: [{
        name: "Income",
        color: '#2E37A4',
        data: [45, 60, 75, 51, 42, 42, 30]
    }],    
}

const sColStacked = {
    chart: {
        height: 230,
        type: 'bar',
        stacked: false,
        toolbar: {
          show: false,
        },
        dataLabels: {
            enabled: false
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%', 
            },
        },
        
        stroke: {
            show: true,
            width: 6,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        },
    },
    series: [{
        name: 'Low',
		color: '#D5D7ED',
        data: [20, 30, 41, 67, 22, 43, 40,10,30,20,40]
    },{
        name: 'High',
		color: '#2E37A4',
        data: [13, 23, 20, 8, 13, 27, 30,25,10,15,20]
    }
],
    
	
}


const donutChart = {
    chart: {
        height: 290,
        type: 'donut',
        toolbar: {
          show: false,
        },
        dataLabels: {
            enabled: false
        },
    },
	 plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '50%'
        },
    },
	series: [44, 55],
	labels: [
        'Male',
        'Female'
    ],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }],
	legend: {
        position: 'bottom',
    }
}

export { areaChart, donutChart, sColStacked };