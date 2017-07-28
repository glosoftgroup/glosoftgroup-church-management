var Index = function () {
 
    // function to initiate Chart 2
    var runChart2 = function () {
        var data_pie = [],
            series = Math.floor(Math.random() * 6) + 3;
        for (var i = 0; i < series; i++) {
            data_pie[i] = {
                label: "Series" + (i + 1),
                data: Math.floor(Math.random() * 100) + 1
            };
        }
        $.plot('#placeholder-h2', data_pie, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    tilt: 0.5,
                    label: {
                        show: true,
                        radius: 1,
                        formatter: labelFormatter,
                        background: {
                            opacity: 0.8
                        }
                    },
                    combine: {
                        color: '#999',
                        threshold: 0.1
                    }
                }
            },
            legend: {
                show: false
            }
        });

        function labelFormatter(label, series) {
            return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
        }
    };
    // function to initiate Chart 3
    var runChart3 = function () {
        var data = [],
            totalPoints = 300;

        function getRandomData() {
            if (data.length > 0)
                data = data.slice(1);
            // Do a random walk
            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50,
                    y = prev + Math.random() * 10 - 5;
                if (y < 0) {
                    y = 0;
                } else if (y > 100) {
                    y = 100;
                }
                data.push(y);
            }
            // Zip the generated y values with the x values
            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]]);
            }
            return res;
        }
        // Set up the control widget
        var updateInterval = 30;
        $("#updateInterval").val(updateInterval).change(function () {
            var v = $(this).val();
            if (v && !isNaN(+v)) {
                updateInterval = +v;
                if (updateInterval < 1) {
                    updateInterval = 1;
                } else if (updateInterval > 2000) {
                    updateInterval = 2000;
                }
                $(this).val("" + updateInterval);
            }
        });
        var plot = $.plot("#placeholder-h3", [getRandomData()], {
            grid: {
                borderWidth: 1,
                borderColor: '#eeeeee'
            },
            series: {
                shadowSize: 0 // Drawing is faster without shadows
            },
            yaxis: {
                min: 0,
                max: 100
            },
            xaxis: {
                show: false
            }
        });

        function update() {
            plot.setData([getRandomData()]);
            // Since the axes don't change, we don't need to call plot.setupGrid()
            plot.draw();
            setTimeout(update, updateInterval);
        }
        update();
    };
    // function to initiate Sparkline
    var runSparkline = function () {
        $(".sparkline_line_good span").sparkline("html", {
            type: "line",
            fillColor: "#B1FFA9",
            lineColor: "#459D1C",
            width: "50",
            height: "24"
        });
        $(".sparkline_line_bad span").sparkline("html", {
            type: "line",
            fillColor: "#FFC4C7",
            lineColor: "#BA1E20",
            width: "50",
            height: "24"
        });
        $(".sparkline_line_neutral span").sparkline("html", {
            type: "line",
            fillColor: "#CCCCCC",
            lineColor: "#757575",
            width: "50",
            height: "24"
        });
        $(".sparkline_bar_good span").sparkline('html', {
            type: "bar",
            barColor: "#459D1C",
            barWidth: "5",
            height: "24"
        });
        $(".sparkline_bar_bad span").sparkline('html', {
            type: "bar",
            barColor: "#BA1E20",
            barWidth: "5",
            height: "24"
        });
        $(".sparkline_bar_neutral span").sparkline('html', {
            type: "bar",
            barColor: "#757575",
            barWidth: "5",
            height: "24"
        });
    };
    // function to initiate EasyPieChart
    var runEasyPieChart = function () {
        if (isIE8 || isIE9) {
            if (!Function.prototype.bind) {
                Function.prototype.bind = function (oThis) {
                    if (typeof this !== "function") {
                        // closest thing possible to the ECMAScript 5 internal IsCallable function
                        throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
                    }
                    var aArgs = Array.prototype.slice.call(arguments, 1),
                        fToBind = this,
                        fNOP = function () {}, fBound = function () {
                            return fToBind.apply(this instanceof fNOP && oThis ? this : oThis, aArgs.concat(Array.prototype.slice.call(arguments)));
                        };
                    fNOP.prototype = this.prototype;
                    fBound.prototype = new fNOP();
                    return fBound;
                };
            }
        }
        $('.easy-pie-chart .bounce').easyPieChart({
            animate: 1000,
            size: 70
        });
        $('.easy-pie-chart .cpu').easyPieChart({
            animate: 1000,
            lineWidth: 3,
            barColor: '#35aa47',
            size: 70
            
        });
    };
   return {
        init: function () {
            //runChart1();
            //runChart2();
            //runChart3();
            runSparkline();
            runEasyPieChart();
           // runFullCalendar();
        }
    };
}();