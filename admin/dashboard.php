<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<style>
    .dashboard-container {
        padding: 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .dashboard-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .dashboard-header h3 {
        color: #ab1a27;
        margin: 0;
    }

    .select-thongke {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    #myfirstchart {
        background-color: #f9f9f9;
        border-radius: 12px;
        padding: 20px;
    }

    .text-date {
        margin-top: 10px;
        font-style: italic;
        color: #555;
    }

    @media (max-width: 768px) {
        #myfirstchart {
            height: 200px;
        }
    }
</style>

<div class="grid_10">
    <div class="dashboard-container">
        <div class="dashboard-header">
            <i class="fa fa-bar-chart" style="font-size: 24px; color:#ab1a27;"></i>
            <h3>Thống kê</h3>
        </div>
        
        <div class="col-md-3">
            <select id="form-control" class="select-thongke">
                <option value="7ngay">—— 7 ngày ——</option>
                <option value="30ngay">—— 30 ngày ——</option>
                <option value="90ngay">—— 90 ngày ——</option>
                <option value="365ngay">—— 1 năm ——</option>
            </select>   

            <div id="myfirstchart" style="height: 250px;"></div>
            <div class="text-date"></div>
        </div>
    </div>
</div>

<!-- Thư viện -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<script>
$(document).ready(function(){
    var chart;
    var defaultTimeRange = '7ngay'; 
    $('.select-thongke').val(defaultTimeRange);

    function updateChart(thoigian) {
        let text = {
            '7ngay': '7 ngày qua',
            '30ngay': '30 ngày qua',
            '90ngay': '90 ngày qua',
            '365ngay': '365 ngày qua'
        }[thoigian] || '';

        $('.text-date').text(text);

        $.ajax({
            url: '../ajax/thongke.php',
            method: 'POST',
            dataType: 'json',
            data: { thoigian: thoigian },
            success: function(chartData) {
                if (chart) {
                    chart.setData(chartData);
                } else {
                    chart = new Morris.Bar({
                        element: 'myfirstchart',
                        data: chartData,
                        xkey: 'year',
                        ykeys: ['donhang', 'danhthu', 'soluong'],
                        labels: ['Số đơn hàng', 'Doanh thu', 'Số lượng'],
                        resize: true,
                        barColors: ['#ab1a27', '#3498db', '#2ecc71'],
                        hideHover: 'auto',
                        hoverCallback: function(index, options, content, row) {
                            return "<div class='morris-hover-row-label'>" + row.selected_duration + "</div>" + content;
                        }
                    });
                }
            },
            error: function(err) {
                console.error("Error loading chart data:", err);
            }
        });
    }

    $('.select-thongke').change(function(){
        updateChart($(this).val());
    });

    updateChart(defaultTimeRange);
});
</script>
