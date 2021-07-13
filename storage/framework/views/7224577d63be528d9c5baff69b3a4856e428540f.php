<?php $__env->startSection('ext_css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-3" style="">
        <div class="hpanel">
            <div class="panel-body text-center h-200">
                <i class="pe-7s-graph1 fa-4x"></i>

                <h1 class="m-xs"><?php echo e($orderCount??0); ?></h1>

                <h3 class="font-extra-bold no-margins text-success">
                    Total Orders
                </h3>
                <a href="<?php echo e(route('admin.orders.index')); ?>">view more</a>
            </div>

        </div>
    </div>
    <div class="col-lg-3" style="">
        <div class="hpanel">
            <div class="panel-body text-center h-200">
                <i class="pe-7s-cash fa-4x"></i>

                <h1 class="m-xs"><?php echo e($saleCount ?? 0); ?></h1>

                <h3 class="font-extra-bold no-margins text-success">
                    Total Sales
                </h3>
                <a href="<?php echo e(route('admin.orders.index')); ?>">view more</a>
            </div>

        </div>
    </div>
    <div class="col-lg-3" style="">
        <div class="hpanel">
            <div class="panel-body text-center h-200">
                <i class="pe-7s-monitor fa-4x"></i>

                <h1 class="m-xs"><?php echo e($customerCount ?? 0); ?></h1>

                <h3 class="font-extra-bold no-margins text-success">
                    Total Customer
                </h3>
                <a href="<?php echo e(route('admin.customers.index')); ?>">view more</a>
            </div>

        </div>
    </div>
    <div class="col-lg-3" style="">
        <div class="hpanel">
            <div class="panel-body text-center h-200">
                <i class="pe-7s-graph1 fa-4x"></i>

                <h2 class="m-xs"><?php echo e($todayOrder??0); ?> | $<?php echo e($todayIncome??0); ?></h2>

                <h3 class="font-extra-bold no-margins text-success">
                    Today Orders
                </h3>
                <a href="<?php echo e(route('admin.orders.index')); ?>">view more</a>
            </div>

        </div>
    </div>
</div>


<div class="row">

    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-heading">
                Recent Orders
            </div>
            <div class="panel-body list">
                <div class="table-responsive project-list">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Order number</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Total Order item</th>
                            <th>Total Cost</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $lastestOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($order->invoice_number); ?></td>
                                <td><?php echo e($order->first_name. ' '. $order->last_name); ?></td>
                                <td><?php echo e($order->email); ?></td>
                                <td><?php echo e($order->phone); ?></td>
                                <td><?php echo e($order->orderItems->count()); ?></td>
                                <td><?php echo e($order->orderItems->sum('price')); ?></td>
                                <td><a href="<?php echo e(route('admin.orders.edit',$order->id)); ?>"><i class="fa fa-eye text-success"></i></a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-6">
                <div class="hpanel">
                    <div class="panel-heading">
                       

                    </div>
                    <div class="panel-body">
                        <div>
                                <div class="col-md-4 pull-right">
                                    <select name="frequency" id="frequency" class="form-control">
                                        <option value="Month">This Month</option>
                                        <option value="Week" selected>This Week</option>
                                        <option value="Year">This Year</option>
                                    </select>
                                </div>
                            <canvas id="lineOptions" height="140"></canvas>
                            <canvas id="barOptions" height="140"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ext_js'); ?>
<script>

    let mychart;

    $(document).ready(function()
    {
        getFrequencyData();
    });

    $('#frequency').on('change', function() {
        getFrequencyData();
    });

    function getFrequencyData()
    {
        if(typeof myChart !== "undefined"){
          myChart.destroy();
        }

        var frequency = $('#frequency').val();

        $.ajax({
        url:'/admin/dashboard/get-frequency-data/'+frequency,
        dataType:"json",
        type: "GET",
        success:function(res)
        {

            /**
            * Options for Line chart
            */
            if(res['frequency'] == 'Year')
            {
                $('#lineOptions').show();
                $('#barOptions').hide();

                for(var i=1;i<13;i++)
                {
                    if(res['oData'][i] == undefined)
                    {
                        res['oData'][i] = 0;
                    }
                    if(res['sData'][i] == undefined)
                    {
                        res['sData'][i] = 0;
                    }
                }
            var orderData = Object.values(res['oData']);
            var salesData = Object.values(res['sData']);

            var lineData = {
            labels: ["January", "February", "March", "April", "May", "June", "July",'August','September','October','November','December'],
            datasets: [
                {
                    label: "Sales",
                    backgroundColor: 'rgba(98,203,49, 0.5)',
                    pointBorderWidth: 1,
                    pointBackgroundColor: "rgba(98,203,49,1)",
                    pointRadius: 3,
                    pointBorderColor: '#ffffff',
                    borderWidth: 1,
                    data:salesData
                },
                {
                    label: "Orders",
                    backgroundColor: 'rgba(220,220,220,0.5)',
                    borderColor: "rgba(220,220,220,0.7)",
                    pointBorderWidth: 1,
                    pointBackgroundColor: "rgba(220,220,220,1)",
                    pointRadius: 3,
                    pointBorderColor: '#ffffff',
                    borderWidth: 1,
                    data: orderData
                }
                ]
            };

            var lineOptions = {
                responsive: true
            };

            var ctx = document.getElementById("lineOptions").getContext("2d");
            myChart = new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

            }

            else
            {

                $('#lineOptions').hide();
                $('#barOptions').show();

                /**
                * Options for Bar chart
                */
                var barOptions = {
                    responsive:true
                };

                if(res['frequency']=='Week')
                {
                    for(var i=0;i<7;i++)
                    {
                        if(res['oData'][i] == undefined)
                        {
                            res['oData'][i] = 0;
                        }
                        if(res['sData'][i] == undefined)
                        {
                            res['sData'][i] = 0;
                        }
                    }
                    var orderData = Object.values(res['oData']);
                    var salesData = Object.values(res['sData']);

                    var barData = {
                    labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday"],
                    datasets: [
                        {
                            label: "Sales",
                            backgroundColor: "rgba(220,220,220,0.5)",
                            borderColor: "rgba(220,220,220,0.8)",
                            highlightFill: "rgba(220,220,220,0.75)",
                            highlightStroke: "rgba(220,220,220,1)",
                            borderWidth: 1,
                            data: salesData
                        },
                        {
                            label: "Orders",
                            backgroundColor: "rgba(98,203,49,0.5)",
                            borderColor: "rgba(98,203,49,0.8)",
                            highlightFill: "rgba(98,203,49,0.75)",
                            highlightStroke: "rgba(98,203,49,1)",
                            borderWidth: 1,
                            data: orderData
                        }
                    ]
                };
                }

                if(res['frequency']=='Month')
                {
                    var labelsArray = [];

                    for(var i=1;i<=res['totalDaysInMonth'];i++)
                    {
                        if(res['oData'][i] == undefined)
                        {
                            res['oData'][i] = 0;
                        }
                        if(res['sData'][i] == undefined)
                        {
                            res['sData'][i] = 0;
                        }
                        labelsArray.push(i);
                    }

                    var orderData = Object.values(res['oData']);
                    var salesData = Object.values(res['sData']);

                    var barData = {
                        labels: labelsArray,
                        datasets: [
                            {
                                label: "Sales",
                                backgroundColor: "rgba(220,220,220,0.5)",
                                borderColor: "rgba(220,220,220,0.8)",
                                highlightFill: "rgba(220,220,220,0.75)",
                                highlightStroke: "rgba(220,220,220,1)",
                                borderWidth: 1,
                                data: salesData
                            },
                            {
                                label: "Orders",
                                backgroundColor: "rgba(98,203,49,0.5)",
                                borderColor: "rgba(98,203,49,0.8)",
                                highlightFill: "rgba(98,203,49,0.75)",
                                highlightStroke: "rgba(98,203,49,1)",
                                borderWidth: 1,
                                data: orderData
                            }
                        ]
                    };
                }
                var ctx = document.getElementById("barOptions").getContext("2d");
                myChart = new Chart(ctx, {type: 'bar', data: barData, options:barOptions});

            }
        }
        });

    }

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/speedyorders/Modules/AdminDashboard/Resources/views/index.blade.php ENDPATH**/ ?>