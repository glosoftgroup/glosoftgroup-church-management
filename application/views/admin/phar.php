<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">Pharmacy Sales - Last 30 Days</div>
            <div id="sales" style="width:100%;height:340px"></div>
        </div>

    </div>

</div>
<div class="row">
    <div class="col-sm-6">

        <div class="panel panel-default">
            <div class="panel-heading">Recent Sales</div>
            <div class="scrollable w340" data-max-height="340" >
                <?php
                if (isset($recent) && count($recent)):
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="9%">#</th>
                                <th width="24%">Time</th>
                                <th width="18%" class="pright" >Amount(KES)</th>
                                <th width="29%">Cashier</th>
                                <th width="10%">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($recent as $r):
                                $user = $this->ion_auth->get_user($r->created_by);
                                ?> 
                                <tr>
                                    <td><?php echo $i . '.'; ?></td>
                                    <td><?php echo $this->dates->createFromTimestamp($r->created_at)->diffForHumans();?></td>
                                    <td class="pright"><?php echo number_format($r->total, 2); ?> </td>
                                    <td><?php echo trim($user->first_name . ' ' . $user->last_name); ?></td>
                                    <td><a class='btn btn-warning' onClick="view('<?php echo $r->id; ?>');" >View</a> </td>
                                </tr>
                                <?php
                                $i++;
                            endforeach;
                            ?>    
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class='text'><?php echo lang('web_no_elements'); ?></p>
                <?php endif ?>
            </div>
        </div>

    </div>
    <div class="col-sm-6" >

        <div class="panel panel-default">
            <div class="panel-heading">Low Stock Items</div>
            <div class="scrollable w340" data-max-height="340" >

                <table class="table">
                    <thead>
                        <tr>
                            <th width="6%">#</th>
                            <th width="70%">Name</th>
                            <th width="24%">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($expired as $m)
                        {
                            $i ++;
                            ?>
                            <tr>
                                <td><?php echo $i . '. '; ?></td>
                                <td><?php echo $m->name; ?></td>
                                <td><?php echo $m->stock; ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div id="rcc" ></div>
<script type="text/javascript">
    var chart;
    var chartData = <?php echo json_encode($daily_sales); ?>;
    AmCharts.ready(function () {
        // SERIAL CHART  
        chart = new AmCharts.AmSerialChart();
        chart.pathToImages = "images/";
        chart.dataProvider = chartData;
        chart.categoryField = "date";
        chart.startDuration = 0;

        // AXES
        var categoryAxis = chart.categoryAxis;
        categoryAxis.gridPosition = "start";
        categoryAxis.labelRotation = 45;

        // value
        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.axisAlpha = 0.2;
        //valueAxis.position = "left";
        valueAxis.title = "Amount in KShs.";
        chart.addValueAxis(valueAxis);

        // column graph
        var graph1 = new AmCharts.AmGraph();
        graph1.type = "column";
        graph1.title = "Sales";
        graph1.valueField = "sales";
        graph1.lineAlpha = 0;
        graph1.balloonText = "[[category]]: Kshs [[value]]";
        graph1.fillAlphas = 1;

        chart.addGraph(graph1);

        // LEGEND                
        var legend = new AmCharts.AmLegend();
        chart.addLegend(legend);

        // WRITE
        chart.write("sales");
    });
</script> 
