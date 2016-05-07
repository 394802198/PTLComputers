
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
    <div class="container">
        <div class="col-md-12">
            <div class="panel-group" id="addAdvertisementAccordion">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <ol class="breadcrumb" style="margin: 0;">
                            <li><a href="/manager" class="text-warning">Home</a></li>
                            <li><a href="/manager#e_store_panel" class="text-warning">E Store</a></li>
                            <li><a href="/manager#e_store_panel" class="text-warning">CMS</a></li>
                            <li><a href="/manager/e_store/cms/advertisement/view_by/pagination" class="text-warning">Advertisement</a></li>
                            <li class="active">Edit Advertisement</li>
                        </ol>
                    </div>
                    <div id="collapseAddAdvertisement" class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="picture" class="control-label col-md-2">Advertisement</label>
                                <?php
                                    $col_md_which = '';
                                    if( in_array( $advertisement['position'], array( 100, 103 ) ) ) $col_md_which = 'col-md-10';
                                    if( in_array( $advertisement['position'], array( 101, 102 ) ) ) $col_md_which = 'col-md-3';
                                    if( in_array( $advertisement['position'], array( 104, 105 ) ) ) $col_md_which = 'col-md-8';

                                    $height = strcasecmp( $col_md_which, 'col-md-3' )==0 ? '300px' : 'auto';
                                ?>
                                <div class="<?php echo $col_md_which ?> advertisement_div">
                                    <img data-name="picture" class="img-thumbnail" src="/<?php echo $advertisement['img_path'] ?>" style="height:<?php echo $height ?>;">
                                    <br/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="picture" class="control-label col-md-2"></label>
                                <div class="col-md-2">
                                    <input type="hidden" id="advertisement_id" value="<?php echo $advertisement['id'] ?>" />
                                    <input type="file" id="picture" name="picture" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="page_type" class="control-label col-md-2">Page Type</label>
                                <div class="col-md-3">
                                    <?php

                                        $pageTypes = array
                                        (
                                            100 => 'Home', 101 => 'Product Search', 102 => 'Product Details',
                                            103 => 'My Cart', 108 => 'DashBoard', 109 => 'My Profile',
                                            110 => 'Change Credential', 111 => 'My Order', 112 => 'Receiver Address',
                                            114 => 'Shipment Tracking', 115 => 'My Wish List'
//                                            200 => 'Custom Page'
                                        );

                                    ?>
                                    <select id="page_type" class="form-control">
                                        <?php foreach( $pageTypes as $code => $pageType ) { ?>
                                            <option value="<?php echo $code ?>" <?php echo $advertisement['page_type'] == $code ? 'selected' : '' ?>><?php echo $pageType ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label for="position" class="control-label col-md-2">Position</label>
                                <div class="col-md-3">
                                    <?php

                                        $positions = array
                                        (
                                            100 => 'Page Top', 101 => 'Page Left', 102 => 'Page Right',
                                            103 => 'Page Bottom', 104 => 'Header Bottom', 105 => 'Footer Top'
                                        );

                                    ?>
                                    <select id="position" class="form-control">
                                        <?php foreach( $positions as $code => $position ) { ?>
                                            <option value="<?php echo $code ?>" <?php echo $advertisement['position'] == $code ? 'selected' : '' ?>><?php echo $position ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_activate_linkage" class="control-label col-md-2">Is Activate Linkage</label>
                                <div class="col-md-3">
                                    <select id="is_activate_linkage" class="form-control">
                                        <option value="Y" <?php echo strcasecmp( $advertisement['is_activate_linkage'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                        <option value="N" <?php echo strcasecmp( $advertisement['is_activate_linkage'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="linkage" class="control-label col-md-2">Linkage</label>
                                <div class="col-md-8">
                                    <input type="text" id="linkage" value="<?php echo $advertisement['linkage'] ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="brief_introduction" class="control-label col-md-2">Brief Introduction</label>
                                <div class="col-md-8">
                                    <textarea id="brief_introduction" class="form-control" rows="4"><?php echo $advertisement['brief_introduction'] ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="is_visible" class="control-label col-md-2">Is Visible</label>
                                <div class="col-md-3">
                                    <select id="is_visible" class="form-control">
                                        <option value="Y" <?php echo strcasecmp( $advertisement['is_visible'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                        <option value="N" <?php echo strcasecmp( $advertisement['is_visible'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="is_auto_hide_count_down_activate" class="control-label col-md-2">Is Auto Hide Count Down Activate</label>
                                <div class="col-md-3">
                                    <select id="is_auto_hide_count_down_activate" class="form-control">
                                        <option value="Y" <?php echo strcasecmp( $advertisement['is_auto_hide_count_down_activate'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                        <option value="N" <?php echo strcasecmp( $advertisement['is_auto_hide_count_down_activate'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="auto_hide_count_down_seconds" class="control-label col-md-2">Auto Hide Count Down Seconds</label>
                                <div class="col-md-3">
                                    <?php

                                        $auto_hide_count_down_seconds = array
                                        (
                                            1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6',
                                            7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12',
                                            13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18',
                                            19 => '19', 20 => '20', 21 => '21', 22 => '22', 23 => '23', 24 => '24',
                                            25 => '25', 26 => '26', 27 => '27', 28 => '28', 29 => '29', 30 => '30'
                                        );

                                    ?>
                                    <select id="auto_hide_count_down_seconds" class="form-control">
                                        <?php foreach( $auto_hide_count_down_seconds as $code => $auto_hide_count_down_second ) { ?>
                                            <option value="<?php echo $code ?>" <?php echo $advertisement['auto_hide_count_down_seconds'] == $code ? 'selected' : '' ?>><?php echo $auto_hide_count_down_second ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="manual_hide_count_down_seconds" class="control-label col-md-2">Manual Hide Count Down Seconds</label>
                                <div class="col-md-3">
                                    <?php

                                    $manual_hide_count_down_seconds = array
                                    (
                                        1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6',
                                        7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12',
                                        13 => '13', 14 => '14', 15 => '15', 16 => '16', 17 => '17', 18 => '18',
                                        19 => '19', 20 => '20', 21 => '21', 22 => '22', 23 => '23', 24 => '24',
                                        25 => '25', 26 => '26', 27 => '27', 28 => '28', 29 => '29', 30 => '30'
                                    );

                                    ?>
                                    <select id="manual_hide_count_down_seconds" class="form-control">
                                        <?php foreach( $manual_hide_count_down_seconds as $code => $manual_hide_count_down_second ) { ?>
                                            <option value="<?php echo $code ?>" <?php echo $advertisement['manual_hide_count_down_seconds'] == $code ? 'selected' : '' ?>><?php echo $manual_hide_count_down_second ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <hr/>
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <a id="edit_advertisement" class="btn btn-warning btn-lg">Add</a>
                                    <a class="btn btn-default btn-lg" href="javascript:history.go( -1 );">Return</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- BEGIN FOOTER -->
<?php include 'includes/manager/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/manager/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<script src="/resources/global/js/ajaxfileupload.js"></script>
<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/e_store/cms/advertisement/edit_advertisement.js"></script>
<!-- END CUSTOMIZED LIB -->
