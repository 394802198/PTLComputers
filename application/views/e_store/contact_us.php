<!-- BEGIN HEADER -->
<?php include 'includes/e_store/header.php'; ?>
<!-- END HEADER -->

<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/panel_body.css" />
<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/commodity-list.css" />

<div class="panel-body" style="background:#00a0e9;">

    <div class="panel_body">

        <!-- BEGIN SIDE DROP DOWN MENU -->
        <?php include 'includes/e_store/side_dropdown_menu.php'; ?>
        <!-- END SIDE DROP DOWN MENU -->

        <div class="col-md-9" style="background:#FFF;">

            <form class="form-horizontal">

                <!--

                    Position = TOP

                -->

                <!-- 如果 is_map_visible = 'Y' 并且 map_position = 100 则显示 -->
                <?php if( isset( $cmsContactUs['is_map_visible'] ) && strcasecmp( $cmsContactUs['is_map_visible'], 'Y' )==0 && $cmsContactUs['map_position'] == 100 ) { ?>
                    <div class="form-group">
                        <?php echo $cmsContactUs['map_iframe'] ?>
                    </div>
                <?php } ?>

                <!-- 如果 info_position = 100 则显示 -->
                <?php if( isset( $cmsContactUs['info_position'] ) && $cmsContactUs['info_position'] == 100 ) { ?>
                    <!-- 如果 地图 不在 TOP，则换行 -->
                    <?php if( strcasecmp( $cmsContactUs['is_map_visible'], 'N' )==0 || $cmsContactUs['map_position'] != 100 ) { ?>
                        <br/>
                    <?php } ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">Contact Info</div>
                        <div class="panel-body">

                            <!-- 地址集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-home" style="font-size:30px;"></i>
                                    </label>
                                    <?php if( isset( $addresses ) && count( $addresses ) > 0 ) { ?>
                                        <?php foreach( $addresses as $address ) { ?>
                                            <p class="form-control-static">
                                                <?php echo $address->name ?>: <?php echo $address->address ?>
                                            </p>
                                        <?php } ?>
                                    <?php } ?>
                                </div>

                            </div>

                            <hr/>

                            <!-- 号码集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-fax" style="font-size:30px;"></i>
                                    </label>
                                    <?php if( isset( $numbers ) && count( $numbers ) > 0 ) { ?>
                                        <?php foreach( $numbers as $number ) { ?>
                                            <p class="form-control-static">
                                                <?php echo $number->name ?>: <?php echo $number->number ?>
                                            </p>
                                        <?php } ?>
                                    <?php } ?>
                                </div>

                            </div>

                            <hr/>

                            <!-- 邮箱集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-envelope" style="font-size:30px;"></i>
                                    </label>
                                    <?php if( isset( $emails ) && count( $emails ) > 0 ) { ?>
                                        <?php foreach( $emails as $email ) { ?>
                                            <p class="form-control-static">
                                                <?php echo $email->name ?>: <?php echo $email->email ?>
                                            </p>
                                        <?php } ?>
                                    <?php } ?>
                                </div>

                            </div>

                            <hr/>

                            <!-- 工作时间集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-clock-o" style="font-size:30px;"></i>
                                    </label>
                                    <?php if( isset( $workingHours ) && count( $workingHours ) > 0 ) { ?>
                                        <?php foreach( $workingHours as $workingHour ) { ?>
                                            <p class="form-control-static">
                                                <?php echo $workingHour->name ?>: <?php echo $workingHour->time_range ?>
                                            </p>
                                        <?php } ?>
                                    <?php } ?>
                                </div>

                            </div>

                        </div>
                    </div>
                <?php } ?>

                <!-- 如果 form_position = 100 则显示 -->
                <?php if( isset( $cmsContactUs['form_position'] ) && $cmsContactUs['form_position'] == 100 ) { ?>
                    <!-- 如果 地图 不在 TOP，则换行 -->
                    <?php if( $cmsContactUs['form_position'] < $cmsContactUs['map_position'] && $cmsContactUs['form_position'] < $cmsContactUs['info_position'] ) { ?>
                        <br/>
                    <?php } ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">Contact Form</div>
                        <div class="panel-body">

                            <div class="form-group">

                                <div class="col-md-12">
                                    <label class="col-md-12">
                                        <i class="fa fa-star-half-empty"></i>
                                        First Name</label>
                                    <div class="col-md-3">
                                        <input type="text" id="first_name" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">
                                        <i class="fa fa-star-half-empty" style="-webkit-transform:rotateY(180deg); -moz-transform:rotateY(180deg); -o-transform:rotateY(180deg); -ms-transform:rotateY(180deg);"></i>
                                        Last Name</label>
                                    <div class="col-md-3">
                                        <input type="text" id="last_name" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">
                                        <i class="fa fa-envelope-square"></i>
                                        Email</label>
                                    <div class="col-md-3">
                                        <input type="text" id="email" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">
                                        <i class="fa fa-phone-square"></i>
                                        Phone</label>
                                    <div class="col-md-3">
                                        <input type="text" id="phone" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">
                                        <i class="fa fa-comments-o"></i>
                                        Enquiry</label>
                                    <div class="col-md-12">
                                        <textarea id="message" class="form-control" rows="5" ></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>
                                            <i class="fa fa-barcode"></i>
                                            Please Enter the code in the box below</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <input type="text" id="captcha_code" class="form-control input-sm" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <img src="<?php echo ROOT_PATH . $_SESSION['captcha']['image_src'] ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <a class="btn btn-primary btn-sm btn-block" id="submit_enquiry">Summit</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                <?php } ?>


                <!--

                    Position = MIDDLE

                -->

                <!-- 如果 is_map_visible = 'Y' 并且 map_position = 101 则显示 -->
                <?php if( isset( $cmsContactUs['is_map_visible'] ) && strcasecmp( $cmsContactUs['is_map_visible'], 'Y' )==0 && $cmsContactUs['map_position'] == 101 ) { ?>
                    <div class="form-group" <?php echo $cmsContactUs['map_position'] > $cmsContactUs['info_position'] && $cmsContactUs['map_position'] > $cmsContactUs['form_position'] ? 'style="margin-bottom:0;"' : '' ?>>
                        <?php echo $cmsContactUs['map_iframe'] ?>
                    </div>
                <?php } ?>

                <!-- 如果 info_position = 101 则显示 -->
                <?php if( isset( $cmsContactUs['info_position'] ) && $cmsContactUs['info_position'] == 101 ) { ?>
                    <!-- 如果 地图 在其下面，则换行 -->
                    <?php if( strcasecmp( $cmsContactUs['is_map_visible'], 'N' )==0 || $cmsContactUs['info_position'] < $cmsContactUs['map_position'] && $cmsContactUs['info_position'] <= $cmsContactUs['form_position'] ) { ?>
                        <br/>
                    <?php } ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">Contact Info</div>
                        <div class="panel-body">

                            <!-- 地址集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-home" style="font-size:30px;"></i>
                                    </label>
                                    <p class="form-control-static">
                                        Glenfield Store: 153 Sunnybrae Road, Hillcrest , Auckland 0627
                                    </p>
                                </div>

                            </div>

                            <hr/>

                            <!-- 号码集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-fax" style="font-size:30px;"></i>
                                    </label>
                                    <p class="form-control-static">
                                        Telephone : 0800 58 78 52
                                    </p>
                                    <p class="form-control-static">
                                        Fax : 09 974 9723
                                    </p>
                                </div>

                            </div>

                            <hr/>

                            <!-- 邮箱集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-envelope" style="font-size:30px;"></i>
                                    </label>
                                    <p class="form-control-static">
                                        Sales Department : sales@ptlcomputers.co.nz
                                    </p>
                                </div>

                            </div>

                            <hr/>

                            <!-- 工作时间集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-clock-o" style="font-size:30px;"></i>
                                    </label>
                                    <p class="form-control-static">
                                        Monday - Friday : 9am - 5pm
                                    </p>
                                    <p class="form-control-static">
                                        Saturday : 10am - 5pm
                                    </p>
                                    <p class="form-control-static">
                                        Sunday & Public Holiday : Closed
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                <?php } ?>

                <!-- 如果 form_position = 101 则显示 -->
                <?php if( isset( $cmsContactUs['form_position'] ) && $cmsContactUs['form_position'] == 101 ) { ?>
                    <!-- 如果 地图、信息 在其下面，则换行 -->
                    <?php if( strcasecmp( $cmsContactUs['is_map_visible'], 'N' )==0 || ( $cmsContactUs['map_position'] > $cmsContactUs['form_position'] && $cmsContactUs['info_position'] > $cmsContactUs['form_position'] ) ) { ?>
                        <br/>
                    <?php } ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">Contact Form</div>
                        <div class="panel-body">

                            <div class="form-group">

                                <div class="col-md-12">
                                    <label class="col-md-12">
                                        <i class="fa fa-comment"></i>First Name
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" id="first_name" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Last Name</label>
                                    <div class="col-md-3">
                                        <input type="text" id="last_name" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Email</label>
                                    <div class="col-md-3">
                                        <input type="text" id="email" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Phone</label>
                                    <div class="col-md-3">
                                        <input type="text" id="phone" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Enquiry</label>
                                    <div class="col-md-12">
                                        <textarea id="message" class="form-control" rows="5" ></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>Please Enter the code in the box below</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <input type="text" id="captcha_code" class="form-control input-sm" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <img src="<?php echo ROOT_PATH . $_SESSION['captcha']['image_src'] ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <a class="btn btn-primary btn-sm btn-block" id="submit_enquiry">Summit</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                <?php } ?>


                <!--

                    Position = BOTTOM

                -->

                <!-- 如果 is_map_visible = 'Y' 并且 map_position = 102 则显示 -->
                <?php if( isset( $cmsContactUs['is_map_visible'] ) && strcasecmp( $cmsContactUs['is_map_visible'], 'Y' )==0 && $cmsContactUs['map_position'] == 102 ) { ?>
                    <div class="form-group" <?php echo $cmsContactUs['map_position'] > $cmsContactUs['info_position'] && $cmsContactUs['map_position'] > $cmsContactUs['form_position'] ? 'style="margin-bottom:0;"' : '' ?>>
                        <?php echo $cmsContactUs['map_iframe'] ?>
                    </div>
                <?php } ?>

                <!-- 如果 info_position = 102 则显示 -->
                <?php if( isset( $cmsContactUs['info_position'] ) && $cmsContactUs['info_position'] == 102 ) { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">Contact Info</div>
                        <div class="panel-body">

                            <!-- 地址集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-home" style="font-size:30px;"></i>
                                    </label>
                                    <p class="form-control-static">
                                        Glenfield Store: 153 Sunnybrae Road, Hillcrest , Auckland 0627
                                    </p>
                                </div>

                            </div>

                            <hr/>

                            <!-- 号码集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-fax" style="font-size:30px;"></i>
                                    </label>
                                    <p class="form-control-static">
                                        Telephone : 0800 58 78 52
                                    </p>
                                    <p class="form-control-static">
                                        Fax : 09 974 9723
                                    </p>
                                </div>

                            </div>

                            <hr/>

                            <!-- 邮箱集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-envelope" style="font-size:30px;"></i>
                                    </label>
                                    <p class="form-control-static">
                                        Sales Department : sales@ptlcomputers.co.nz
                                    </p>
                                </div>

                            </div>

                            <hr/>

                            <!-- 工作时间集 -->
                            <div class="form-group">

                                <div class="col-md-12">
                                    <label>
                                        <i class="fa fa-clock-o" style="font-size:30px;"></i>
                                    </label>
                                    <p class="form-control-static">
                                        Monday - Friday : 9am - 5pm
                                    </p>
                                    <p class="form-control-static">
                                        Saturday : 10am - 5pm
                                    </p>
                                    <p class="form-control-static">
                                        Sunday & Public Holiday : Closed
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                <?php } ?>

                <!-- 如果 form_position = 102 则显示 -->
                <?php if( isset( $cmsContactUs['form_position'] ) && $cmsContactUs['form_position'] == 102 ) { ?>

                    <div class="panel panel-info">
                        <div class="panel-heading">Contact Form</div>
                        <div class="panel-body">

                            <div class="form-group">

                                <div class="col-md-12">
                                    <label class="col-md-12">First Name</label>
                                    <div class="col-md-3">
                                        <input type="text" id="first_name" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Last Name</label>
                                    <div class="col-md-3">
                                        <input type="text" id="last_name" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Email</label>
                                    <div class="col-md-3">
                                        <input type="text" id="email" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Phone</label>
                                    <div class="col-md-3">
                                        <input type="text" id="phone" class="form-control input-sm" />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-md-12">Enquiry</label>
                                    <div class="col-md-12">
                                        <textarea id="message" class="form-control" rows="5" ></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>Please Enter the code in the box below</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <input type="text" id="captcha_code" class="form-control input-sm" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <img src="<?php echo ROOT_PATH . $_SESSION['captcha']['image_src'] ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <a class="btn btn-primary btn-sm btn-block" id="submit_enquiry">Summit</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                <?php } ?>


            </form>

        </div>
    </div>

</div>

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN FOOTER -->
<?php include 'includes/e_store/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/left_side.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/contact_us.js"></script>
<!-- END CUSTOMIZED LIB -->