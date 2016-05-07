
<?php include 'includes/manager/header.php'; ?>

<form class="form-horizontal">
<div class="container">
    <div class="col-md-12">
        <div class="panel-group" id="editContactUsAccordion">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-warning">Home</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">EStore</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">CMS</a></li>
                        <li><a href="/manager#e_store_panel" class="text-warning">Configuration</a></li>
                        <li class="active">Contact Us</li>
                    </ol>
                </div>
                <div id="collapseEditContactUs" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="subject" class="control-label col-md-2">Subject</label>
                            <div class="col-md-3">
                                <input type="text" id="subject" value="<?php echo isset( $cmsContactUs['subject'] ) ? $cmsContactUs['subject'] : '' ?>" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_receiver_email_activate" class="control-label col-md-2">Receiver Email Activate</label>
                            <div class="col-md-3">
                                <select class="form-control" id="is_receiver_email_activate">
                                    <option value="Y" <?php echo isset( $cmsContactUs['is_receiver_email_activate'] ) && strcasecmp( $cmsContactUs['is_receiver_email_activate'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                    <option value="N" <?php echo isset( $cmsContactUs['is_receiver_email_activate'] ) && strcasecmp( $cmsContactUs['is_receiver_email_activate'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receiver_email" class="control-label col-md-2">Receiver Email</label>
                            <div class="col-md-3">
                                <input type="text" id="receiver_email" value="<?php echo isset( $cmsContactUs['receiver_email'] ) ? $cmsContactUs['receiver_email'] : '' ?>" class="form-control" placeholder="*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_map_visible" class="control-label col-md-2">Map Visible</label>
                            <div class="col-md-3">
                                <select class="form-control" id="is_map_visible">
                                    <option value="Y" <?php echo isset( $cmsContactUs['is_map_visible'] ) && strcasecmp( $cmsContactUs['is_map_visible'], 'Y' )==0 ? 'selected' : '' ?>>YES</option>
                                    <option value="N" <?php echo isset( $cmsContactUs['is_map_visible'] ) && strcasecmp( $cmsContactUs['is_map_visible'], 'N' )==0 ? 'selected' : '' ?>>NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="map_iframe" class="control-label col-md-2">Map iFrame</label>
                            <div class="col-md-8">
                                <textarea id="map_iframe" class="form-control" rows="4"><?php echo isset( $cmsContactUs['map_iframe'] ) ? $cmsContactUs['map_iframe'] : '' ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="map_position" class="control-label col-md-2">Map Position</label>
                            <div class="col-md-3">
                                <select class="form-control" id="map_position">
                                    <option value="100" <?php echo isset( $cmsContactUs['map_position'] ) && $cmsContactUs['map_position'] == 100 ? 'selected' : '' ?>>TOP</option>
                                    <option value="101" <?php echo isset( $cmsContactUs['map_position'] ) && $cmsContactUs['map_position'] == 101 ? 'selected' : '' ?>>MIDDLE</option>
                                    <option value="102" <?php echo isset( $cmsContactUs['map_position'] ) && $cmsContactUs['map_position'] == 102 ? 'selected' : '' ?>>BOTTOM</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="info_position" class="control-label col-md-2">Info Position</label>
                            <div class="col-md-3">
                                <select class="form-control" id="info_position">
                                    <option value="100" <?php echo isset( $cmsContactUs['info_position'] ) && $cmsContactUs['info_position'] == 100 ? 'selected' : '' ?>>TOP</option>
                                    <option value="101" <?php echo isset( $cmsContactUs['info_position'] ) && $cmsContactUs['info_position'] == 101 ? 'selected' : '' ?>>MIDDLE</option>
                                    <option value="102" <?php echo isset( $cmsContactUs['info_position'] ) && $cmsContactUs['info_position'] == 102 ? 'selected' : '' ?>>BOTTOM</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="form_position" class="control-label col-md-2">Form Position</label>
                            <div class="col-md-3">
                                <select class="form-control" id="form_position">
                                    <option value="100" <?php echo isset( $cmsContactUs['form_position'] ) && $cmsContactUs['form_position'] == 100 ? 'selected' : '' ?>>TOP</option>
                                    <option value="101" <?php echo isset( $cmsContactUs['form_position'] ) && $cmsContactUs['form_position'] == 101 ? 'selected' : '' ?>>MIDDLE</option>
                                    <option value="102" <?php echo isset( $cmsContactUs['form_position'] ) && $cmsContactUs['form_position'] == 102 ? 'selected' : '' ?>>BOTTOM</option>
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <a id="edit_contact_us" class="btn btn-warning btn-lg btn-block">Edit</a>
                            </div>
                        </div>
                        <hr/>

                        <!-- Address -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        Address
                                        <a class="btn btn-success btn-xs pull-right" id="add_address_btn">
                                            <span class="glyphicon glyphicon-plus"></span>
                                            Add
                                        </a>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Name</th>
                                                    <th width="42%">Address (Office/Warehouse,etc...)</th>
                                                    <th width="15%">Sequence</th>
                                                    <th width="23%">Operation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if( isset( $addresses ) ) { ?>
                                                    <?php foreach( $addresses as $address ) { ?>
                                                        <tr>
                                                            <td>
                                                                <input type="text" data-name="address_name" value="<?php echo $address->name ?>" data-id="<?php echo $address->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td>
                                                                <input type="text" data-name="address_address" value="<?php echo $address->address ?>" data-id="<?php echo $address->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td>
                                                                <input type="number" data-name="address_sequence" value="<?php echo $address->sequence ?>" data-id="<?php echo $address->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group">
                                                                    <a class="btn btn-primary btn-sm" data-name="edit_address_btn" data-id="<?php echo $address->id ?>">
                                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                                        Edit
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm" data-name="delete_address_btn" data-id="<?php echo $address->id ?>">
                                                                        <span class="glyphicon glyphicon-trash"></span>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Number -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        Number
                                        <a class="btn btn-success btn-xs pull-right" id="add_number_btn">
                                            <span class="glyphicon glyphicon-plus"></span>
                                            Add
                                        </a>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Name</th>
                                                    <th width="42%">Number (Phone/Fax,etc...)</th>
                                                    <th width="15%">Sequence</th>
                                                    <th width="23%">Operation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if( isset( $numbers ) ) { ?>
                                                    <?php foreach( $numbers as $number ) { ?>
                                                        <tr>
                                                            <td>
                                                                <input type="text" data-name="number_name" value="<?php echo $number->name ?>" data-id="<?php echo $number->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td>
                                                                <input type="text" data-name="number_number" value="<?php echo $number->number ?>" data-id="<?php echo $number->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td>
                                                                <input type="number" data-name="number_sequence" value="<?php echo $number->sequence ?>" data-id="<?php echo $number->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group">
                                                                    <a class="btn btn-primary btn-sm" data-name="edit_number_btn" data-id="<?php echo $number->id ?>">
                                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                                        Edit
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm" data-name="delete_number_btn" data-id="<?php echo $number->id ?>">
                                                                        <span class="glyphicon glyphicon-trash"></span>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Email -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        Email
                                        <a class="btn btn-success btn-xs pull-right" id="add_email_btn">
                                            <span class="glyphicon glyphicon-plus"></span>
                                            Add
                                        </a>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Name</th>
                                                    <th width="42%">Email (Sales/Admin,etc...)</th>
                                                    <th width="15%">Sequence</th>
                                                    <th width="23%">Operation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if( isset( $emails ) ) { ?>
                                                    <?php foreach( $emails as $email ) { ?>
                                                        <tr>
                                                            <td>
                                                                <input type="text" data-name="email_name" value="<?php echo $email->name ?>" data-id="<?php echo $email->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td>
                                                                <input type="text" data-name="email_email" value="<?php echo $email->email ?>" data-id="<?php echo $email->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td>
                                                                <input type="number" data-name="email_sequence" value="<?php echo $email->sequence ?>" data-id="<?php echo $email->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group">
                                                                    <a class="btn btn-primary btn-sm" data-name="edit_email_btn" data-id="<?php echo $email->id ?>">
                                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                                        Edit
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm" data-name="delete_email_btn" data-id="<?php echo $email->id ?>">
                                                                        <span class="glyphicon glyphicon-trash"></span>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Working Hour -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        Working Hour
                                        <a class="btn btn-success btn-xs pull-right" id="add_working_hour_btn">
                                            <span class="glyphicon glyphicon-plus"></span>
                                            Add
                                        </a>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Name</th>
                                                    <th width="42%">Working Hour (Monday/Friday,etc...)</th>
                                                    <th width="15%">Sequence</th>
                                                    <th width="23%">Operation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if( isset( $workingHours ) ) { ?>
                                                    <?php foreach( $workingHours as $workingHour ) { ?>
                                                        <tr>
                                                            <td>
                                                                <input type="text" data-name="working_hour_name" value="<?php echo $workingHour->name ?>" data-id="<?php echo $workingHour->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td>
                                                                <input type="text" data-name="working_hour_time_range" value="<?php echo $workingHour->time_range ?>" data-id="<?php echo $workingHour->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td>
                                                                <input type="number" data-name="working_hour_sequence" value="<?php echo $workingHour->sequence ?>" data-id="<?php echo $workingHour->id ?>" class="form-control input-sm">
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group">
                                                                    <a class="btn btn-primary btn-sm" data-name="edit_working_hour_btn" data-id="<?php echo $workingHour->id ?>">
                                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                                        Edit
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm" data-name="delete_working_hour_btn" data-id="<?php echo $workingHour->id ?>">
                                                                        <span class="glyphicon glyphicon-trash"></span>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>


<!--

    Working Hour BEGIN

-->

<!-- Delete Working Hour Modal -->
<div class="modal fade" id="deleteWorkingHourModal" tabindex="-1" role="dialog" aria-labelledby="deleteWorkingHourModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteWorkingHourModalLabel">Delete Working Hour</h4>
            </div>
            <div class="modal-body">
                Sure to delete this Working Hour?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-warning" id="deleteWorkingHourConfirm">Confirm Delete</button>
            </div>
        </div>
    </div>
</div>

<form class="form-horizontal">
    <!-- Add Working Hour Modal -->
    <div class="modal fade" id="addWorkingHourModal" tabindex="-1" role="dialog" aria-labelledby="addWorkingHourModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addWorkingHourModalLabel">Add Working Hour</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-2">Name</label>
                        <div class="col-md-4">
                            <input type="text" id="add_working_hour_name" class="form-control input-sm" placeholder="*" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Time Range</label>
                        <div class="col-md-8">
                            <input type="text" id="add_working_hour_time_range" class="form-control input-sm" placeholder="*" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                    <button type="button" class="btn btn-warning" id="addWorkingHourConfirm">Confirm Add</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--

    Working Hour END

-->


<!--

    Email BEGIN

-->

<!-- Delete Email Modal -->
<div class="modal fade" id="deleteEmailModal" tabindex="-1" role="dialog" aria-labelledby="deleteEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteEmailModalLabel">Delete Email</h4>
            </div>
            <div class="modal-body">
                Sure to delete this Email?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-warning" id="deleteEmailConfirm">Confirm Delete</button>
            </div>
        </div>
    </div>
</div>

<form class="form-horizontal">
    <!-- Add Email Modal -->
    <div class="modal fade" id="addEmailModal" tabindex="-1" role="dialog" aria-labelledby="addEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addEmailModalLabel">Add Email</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-2">Name</label>
                        <div class="col-md-4">
                            <input type="text" id="add_email_name" class="form-control input-sm" placeholder="*" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Email</label>
                        <div class="col-md-8">
                            <input type="text" id="add_email_email" class="form-control input-sm" placeholder="*" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                    <button type="button" class="btn btn-warning" id="addEmailConfirm">Confirm Add</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--

    Email END

-->



<!--

    Number BEGIN

-->

<!-- Delete Number Modal -->
<div class="modal fade" id="deleteNumberModal" tabindex="-1" role="dialog" aria-labelledby="deleteNumberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteNumberModalLabel">Delete Number</h4>
            </div>
            <div class="modal-body">
                Sure to delete this Number?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-warning" id="deleteNumberConfirm">Confirm Delete</button>
            </div>
        </div>
    </div>
</div>

<form class="form-horizontal">
    <!-- Add Number Modal -->
    <div class="modal fade" id="addNumberModal" tabindex="-1" role="dialog" aria-labelledby="addNumberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addNumberModalLabel">Add Number</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-2">Name</label>
                        <div class="col-md-4">
                            <input type="text" id="add_number_name" class="form-control input-sm" placeholder="*" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Number</label>
                        <div class="col-md-8">
                            <input type="text" id="add_number_number" class="form-control input-sm" placeholder="*" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                    <button type="button" class="btn btn-warning" id="addNumberConfirm">Confirm Add</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--

    Number END

-->



<!--

    Address BEGIN

-->

<!-- Delete Address Modal -->
<div class="modal fade" id="deleteAddressModal" tabindex="-1" role="dialog" aria-labelledby="deleteAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteAddressModalLabel">Delete Address</h4>
            </div>
            <div class="modal-body">
                Sure to delete this Address?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-warning" id="deleteAddressConfirm">Confirm Delete</button>
            </div>
        </div>
    </div>
</div>

<form class="form-horizontal">
    <!-- Add Address Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-labelledby="addAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addAddressModalLabel">Add Address</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-2">Name</label>
                        <div class="col-md-4">
                            <input type="text" id="add_address_name" class="form-control input-sm" placeholder="*" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Address</label>
                        <div class="col-md-8">
                            <input type="text" id="add_address_address" class="form-control input-sm" placeholder="*" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                    <button type="button" class="btn btn-warning" id="addAddressConfirm">Confirm Add</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--

    Address END

-->

<!-- BEGIN FOOTER -->
<?php include 'includes/manager/footer.php'; ?>
<!-- END FOOTER -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/global/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN DEPENDENT LIB -->
<?php require 'includes/manager/scripts.php' ?>
<!-- END DEPENDENT LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/e_store/cms/configuration/contact_us/edit.js"></script>
<!-- END CUSTOMIZED LIB -->
