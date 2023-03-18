<?php require 'layout/header.php'; ?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php require 'layout/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <p>
                        <select class="select-date"
                            style="padding: 5px 10px;border: 1px solid #ddd;border-radius: 5px;border-color: gray;">
                            <option value="">---Select---</option>
                            <option value="7day">7 ngày</option>
                            <option value="28day">28 ngày</option>
                            <option value="90day">90 ngày</option>
                            <option value="360day">360 ngày</option>
                        </select>
                    </p>
                    <h3 id="index" class="fl-left">Thống kê đơn hàng: <span id="text-date"></span></h3>

                    <?php
                        // require("../carbon/autoload.php");
                        // use Carbon\Carbon;
                        // use Carbon\CarbonInterval;
                        // printf("Now: %s",Carbon::now("Asia/Ho_Chi_Minh"));
                        // printf("1 day: %s", CarbonInterval::day()->forHumans());
                        $chart_data = "";
                        foreach ($data as $value)  {
                                $chart_data .= "{ date:'".$value["order_date"]."', order:".$value["order_number"].", sales:".$value["statistical"].", quantity:".$value["quantity"]."}, ";
                           }
                    
                           $chart_data = substr($chart_data, 0, -2);
                    ?>
                    <div id="chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var char = new Morris.Area({
            //Donut Line Bar
            element: 'chart',

            xkey: 'date',

            data: [<?php echo $chart_data; ?>],

            ykeys: ['date', 'order', 'sales', 'quantity'],

            labels: ['Đơn hàng', 'Doanh thu', 'Số lượng bán ra']
        });

        var text = '365 ngày qua';
        $('#text-date').text(text);

        $('.select-date').change(function() {
            var day = $(this).val();
            if (day == "7day") {
                var text = "7 ngày qua";
            } else if (day == "28day") {
                var text = "28 ngày qua";
            } else if (day == "90day") {
                var text = "90 ngày qua";
            } else {
                var text = "365 ngày qua";
            }
            $('#text-date').text(text);
        })
    });
    </script>
    <?php require 'layout/footer.php'; ?>