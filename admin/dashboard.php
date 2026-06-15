
<!-- Top Bar Start -->
<?php include('include/left_slidebar.php');?>
<!-- Top Bar End -->

<!-- Top Bar Start -->
<?php include('include/top_header.php');?>
<!-- Top Bar End -->

<!-- Content wrapper -->
<div class="content-wrapper " >
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Total Revenue -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-12">
                            <h5 class="card-header m-0 me-2 pb-3">Total News</h5>
                            <div id="totalRevenueChart" class="px-2"></div>
                        </div>

                    </div>
                </div>
            </div>
            <!--/ Total Revenue -->




            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="assets/img/icons/unicons/wallet.png" alt="Credit Card" class="rounded" />
                                    </div>
                                    <?php
                                    include "OOP.php";
                                    $obj=new database();
                                    $result= $obj->getcategories();
                                    $count = $result->num_rows;

                                    ?>
                                    <h3 class="card-title text-nowrap mb-2"><?= $count?></h3>
                                </div>
                                <span class="d-block mb-1">Total Categories</span>

                                <!--                                            <small class="text-danger fw-medium"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                    </div>
                                    <div class="dropdown">

                                        <?php

                                        $obj=new database();
                                        $result= $obj->showoversubcategory();
                                        $countsubcate = $result->num_rows;

                                        ?>

                                        <h3 class="card-title mb-2"> <?=$countsubcate?></h3>
                                    </div>
                                </div>
                                <span class="fw-medium d-block mb-1">Sub Categories</span>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                        <div class="card-title">
                                            <h5 class="text-nowrap mb-2"> Total User</h5>
                                            <span class="badge bg-label-warning rounded-pill">Year 2024</span>
                                        </div>
                                        <div class="mt-sm-auto">
                                            <small class="text-success text-nowrap fw-medium">
                                                <?php

                                                $obj=new database();
                                                $result= $obj->user();
                                                $countUser = $result->num_rows;

                                                ?>

                                                <h3 class="mb-0"><?= $countUser?></h3>
                                        </div>
                                    </div>
                                    <div id="profileReportChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--                 Recent news post   -->
        <div class="col-sm-12">
            <div class="card">
                <h5 class="card-header m-0 me-2 pb-3">Recent News Post</h5>
                <div class="table-responsive tbl-fixed " style="max-height: 50vh;">
                    <table class="table " id="example">
                        <thead class="table-primary">
                        <tr class="table-bordered">
                            <th style="width: 400px;"><span class="d-block mb-1">Description</span></th>
                            <th><span class="d-block mb-1">Category</span></th>
                            <th><span class="d-block mb-1">Sub-Category</span></th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php
                        $obj=new database();
                        $result=$obj->getrecentnewsbyadmin();
                        if($result->num_rows > 0){
                            while($row=$result->fetch_assoc()){
                                ?>

                                <tr  >
                                    <td><span class="d-block mb-1"></span><?= $row['description'] ?></td>
                                    <td><span class="d-block mb-1"></span><?= $row['category'] ?></td>
                                    <td><span class="d-block mb-1"></span><?= $row['sub_category'] ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>




    </div>
</div>
<!-- / Content -->

<!-- Top Bar Start -->
<?php include('include/footer.php');?>

<script>
    'use strict';

    (function () {

        <?php
        $obj = new database();
        $result = $obj->newsCount();
        $categories = array();
        $count = array();


        while ($row = $result->fetch_assoc()) {
            $categories[] = $row["category"];
            $count[] = $row["news_count"];


        }

        $jsonArray = json_encode($categories);
        $jsonCount=json_encode($count);
        ?>

        let cardColor, headingColor, axisColor, shadeColor, borderColor;

        cardColor = config.colors.cardColor;
        headingColor = config.colors.headingColor;
        axisColor = config.colors.axisColor;
        borderColor = config.colors.borderColor;

        // Total Revenue Report Chart - Bar Chart
        // --------------------------------------------------------------------
        const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
            totalRevenueChartOptions = {
                series: [
                    {
                        data: <?php echo $jsonCount; ?>
                    }
                ],
                chart: {
                    height: 300,
                    stacked: true,
                    type: 'bar',
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '33%',
                        borderRadius: 12,
                        startingShape: 'rounded',
                        endingShape: 'rounded'
                    }
                },
                colors: [config.colors.primary, config.colors.info],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 6,
                    lineCap: 'round',
                    colors: [cardColor]
                },
                legend: {
                    show: true,
                    horizontalAlign: 'left',
                    position: 'top',
                    markers: {
                        height: 8,
                        width: 8,
                        radius: 12,
                        offsetX: -3
                    },
                    labels: {
                        colors: axisColor
                    },
                    itemMargin: {
                        horizontal: 10
                    }
                },
                grid: {
                    borderColor: borderColor,
                    padding: {
                        top: 0,
                        bottom: -8,
                        left: 20,
                        right: 20
                    }
                },
                xaxis: {
                    categories: <?php echo $jsonArray; ?>,
                    labels: {
                        style: {
                            fontSize: '13px',
                            colors: axisColor
                        }
                    },
                    axisTicks: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '13px',
                            colors: axisColor
                        }
                    }
                },
                responsive: [
                    // Your responsive options...
                ],
                states: {
                    hover: {
                        filter: {
                            type: 'none'
                        }
                    },
                    active: {
                        filter: {
                            type: 'none'
                        }
                    }
                }
            };

        if (typeof totalRevenueChartEl !== 'undefined' && totalRevenueChartEl !== null) {
            const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
            totalRevenueChart.render();
        }
        const profileReportChartEl = document.querySelector('#profileReportChart'),
            profileReportChartConfig = {
                chart: {
                    height: 80,
                    // width: 175,
                    type: 'line',
                    toolbar: {
                        show: false
                    },
                    dropShadow: {
                        enabled: true,
                        top: 10,
                        left: 5,
                        blur: 3,
                        color: config.colors.warning,
                        opacity: 0.15
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                grid: {
                    show: false,
                    padding: {
                        right: 8
                    }
                },
                colors: [config.colors.warning],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 5,
                    curve: 'smooth'
                },
                series: [
                    {
                        data: [110, 270, 145, 245, 205, 285]
                    }
                ],
                xaxis: {
                    show: false,
                    lines: {
                        show: false
                    },
                    labels: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    show: false
                }
            };
        if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
            const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
            profileReportChart.render();
        }
    })();
</script>

<!-- Top Bar End -->

