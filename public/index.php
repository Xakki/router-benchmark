<?php

?>

<button onclick="startFlag = true; startTest();">Start</button>
<button onclick="stopTest()">Stop</button>

<div>
    <canvas id="myChart1"></canvas>
</div>

<div>
    <canvas id="myChart2"></canvas>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const canvas1 = document.getElementById('myChart1');
    canvas1.height = 75;

    const canvas2 = document.getElementById('myChart2');
    canvas2.height = 75;

    const test1color = 'rgb(183,82,102)';
    const test11color = 'rgb(255,0,52)';
    const test2color = 'rgb(60,67,141)';
    const test22color = 'rgb(61,78,255)';
    const test3color = 'rgb(63,134,57)';
    const test33color = 'rgb(67,255,41)';


    const myChart1 = new Chart(
        canvas1,
        {
            type: 'line',
            data: {
                labels: [],
                datasets: []
            },
            options: {}
        }
    );

    const myChart2 = new Chart(
        canvas2,
        {
            type: 'line',
            data: {
                labels: [],
                datasets: []
            },
            options: {}
        }
    );

    function addChartLine(i, color, data)
    {
        console.log(data);

        if (typeof myChart1.data.datasets[i] == "undefined") {
            myChart1.data.datasets[i] = {
                label: data.name + ' requestTime9Sum',
                backgroundColor: color,
                borderColor: color,
                data: [],
            }
        }
        myChart1.data.datasets[i].data.push(data.requestTime9Sum);

        if (typeof myChart2.data.datasets[i] == "undefined") {
            myChart2.data.datasets[i] = {
                label: data.name + ' requestTime9Avg',
                backgroundColor: color,
                borderColor: color,
                data: [],
            }
        }
        myChart2.data.datasets[i].data.push(data.requestTime9Avg);

        // if (typeof myChart1.data.datasets[i+1] == "undefined") {
        //     myChart1.data.datasets[i+1] = {
        //         label: data.name + ' phpTime9Sum',
        //         backgroundColor: color,
        //         borderColor: color,
        //         data: [],
        //     }
        // }
        // myChart1.data.datasets[i+1].data.push(data.phpTime9Sum);
        //
        // if (typeof myChart2.data.datasets[i+1] == "undefined") {
        //     myChart2.data.datasets[i+1] = {
        //         label: data.name + ' phpTime9Avg',
        //         backgroundColor: color,
        //         borderColor: color,
        //         data: [],
        //     }
        // }
        // myChart2.data.datasets[i+1].data.push(data.phpTime9Avg);

        // chart.data.datasets[i].data.push(data.phpMemSum);
        // chart.data.datasets[i].data.push(data.phpMemAvg);
    }

    let startFlag = false;
    let cnt = 0;

    async function startTest() {

        if (cnt > 0) {
            myChart1.data.labels.push(cnt);
            myChart2.data.labels.push(cnt);
        }
        cnt++

        fetch('http://localhost:8080/test1.php?count=1000')
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (cnt > 1) addChartLine(0, test1color, data)
                return fetch('http://localhost:8081/test1.php?count=1000');
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (cnt > 1) addChartLine(1, test11color, data)
                return fetch('http://localhost:8080/test2.php?count=1000');
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (cnt > 1) addChartLine(2, test2color, data)
                return fetch('http://localhost:8081/test2.php?count=1000');
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (cnt > 1) addChartLine(3, test22color, data)
                return fetch('http://localhost:8080/test3.php?count=1000');
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (cnt > 1) addChartLine(4, test3color, data)
                return fetch('http://localhost:8081/test3.php?count=1000');
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (cnt > 1) addChartLine(5, test33color, data)

                myChart1.update();
                myChart2.update();

                if (startFlag) {
                    setTimeout(function () {
                        startTest();
                    }, 2000);
                }
            })
            .catch(function (error) {
                console.log('Error', error)
            })

    }

    function stopTest() {
        startFlag = false;
    }

</script>




