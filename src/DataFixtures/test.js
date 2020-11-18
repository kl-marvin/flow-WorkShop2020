const options = {
    chart: {
        type: 'heatmap'
    },
    series: [
        {
            name: 'Monday', data: [{x: '06h-07h', y: 17},{x: '09h-10h', y: 50},{x: '10h-11h', y: 100},]
        }, {
            name: 'Tuesday', data: [{x: '12h-13h', y: 300},


            ]
        }, {
            name: 'Wednesday', data: [{x: '13h-14h', y: 50},


                {x: '15h-16h', y: 300},

            ]
        }

    ]
};


const chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();


