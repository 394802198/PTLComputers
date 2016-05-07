<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<link rel="stylesheet" href="/resources/manager/css/home.css" rel="stylesheet" type="text/css" />
<!-- END HEADER -->
<style>
    .xerp-row-panel-small {
        height: 160px;
    }
    .xerp-row-panel-medium-small {
        height: 210px;
    }
    .xerp-row-panel-medium {
        height: 290px;
    }
    .xerp-row-panel-medium-large {
        height: 390px;
    }
    .xerp-row-panel-medium-medium-large {
        height: 450px;
    }
    .xerp-row-panel-large {
        height: 500px;
    }
    .third-row-panel-success {
        min-height: 400px;
    }
    hr {
        margin:10px;
    }
    ul.list-unstyled > li {
        margin-bottom: 3px;
    }
</style>

<div class="container">
    <!-- BEGIN LEFT COLUMN -->
    <!-- BEGIN LEFT FIRST COLUMN -->


    <!--

    Notification Board

    -->

        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><strong>NOTIFICATION BOARD</strong></h3>
            </div>
            <div class="panel-body">

                <!-- Remarketing -->
                <?php include 'includes/manager/home/notification/remarketing.php'; ?>

                <!-- EStore -->
                <?php include 'includes/manager/home/notification/e_store.php'; ?>

<!--                <div class="col-md-6">-->
<!--                     Product Module -->
<!--                    <div class="panel xerp-row-panel-medium-small">&nbsp;-->
<!--                    </div>-->
<!--                </div>-->
                <!-- Repair -->
                <?php include 'includes/manager/home/notification/service.php'; ?>

                <!-- Accounting -->
<!--                --><?php //include 'includes/manager/home/notification/accounting.php'; ?>

                <!-- Warehouse -->
<!--                --><?php //include 'includes/manager/home/notification/warehouse.php'; ?>

            </div>
        </div>

    <!-- Remarketing -->
    <?php include 'includes/manager/home/panel/remarketing.php'; ?>

    <!-- EStore -->
    <?php include 'includes/manager/home/panel/e_store.php'; ?>

    <!-- Service -->
    <?php include 'includes/manager/home/panel/service.php'; ?>

    <!-- WAREHOUSE -->
    <?php include 'includes/manager/home/panel/warehouse.php'; ?>

    <!-- CORE -->
    <?php include 'includes/manager/home/panel/core.php'; ?>


</div>

<!-- BEGIN FOOTER -->
<?php include 'includes/manager/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/manager/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<script>
    var estoreState = '<?php echo $coreStatus['estore_state'] ?>';
    var remarketingState = '<?php echo $coreStatus['remarketing_state'] ?>';
</script>
<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/home.js"></script>
<!-- END CUSTOMIZED LIB -->