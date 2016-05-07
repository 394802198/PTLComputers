
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
                        <li class="active">Add Advertisement</li>
                    </ol>
                </div>
                <div id="collapseAddAdvertisement" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="picture" class="control-label col-md-2">Advertisement</label>
                            <div class="col-md-10 advertisement_div">
                                <img data-name="picture" class="img-thumbnail" src="/resources/global/image/default_img.svg" height="auto">
                                <br/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="picture" class="control-label col-md-2"></label>
                            <div class="col-md-2">
                                <input type="file" id="picture" name="picture" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="page_type" class="control-label col-md-2">Page Type</label>
                            <div class="col-md-3">
                                <select id="page_type" class="form-control">
                                    <option value="100">Home</option>
                                    <option value="101">Product Search</option>
                                    <option value="102">Product Detail</option>
                                    <option value="103">My Cart</option>
                                    <option value="108">Dashboard</option>
                                    <option value="109">My Profile</option>
                                    <option value="110">Change Credential</option>
                                    <option value="111">My Order</option>
                                    <option value="112">Receiver Address</option>
                                    <option value="114">Shipment Tracking</option>
                                    <option value="115">My Wish List</option>
<!--                                    <option value="200">Custom Page</option>-->
                                </select>
                            </div>
                            <label for="position" class="control-label col-md-2">Position</label>
                            <div class="col-md-3">
                                <select id="position" class="form-control">
                                    <option value="100">Page Top</option>
                                    <option value="101">Page Left</option>
                                    <option value="102">Page Right</option>
                                    <option value="103">Page Bottom</option>
                                    <option value="104">Header Bottom</option>
                                    <option value="105">Footer Top</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_activate_linkage" class="control-label col-md-2">Is Activate Linkage</label>
                            <div class="col-md-3">
                                <select id="is_activate_linkage" class="form-control">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="linkage" class="control-label col-md-2">Linkage</label>
                            <div class="col-md-8">
                                <input type="text" id="linkage" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="brief_introduction" class="control-label col-md-2">Brief Introduction</label>
                            <div class="col-md-8">
                                <textarea id="brief_introduction" class="form-control" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_visible" class="control-label col-md-2">Is Visible</label>
                            <div class="col-md-3">
                                <select id="is_visible" class="form-control">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_auto_hide_count_down_activate" class="control-label col-md-2">Is Auto Hide Count Down Activate</label>
                            <div class="col-md-3">
                                <select id="is_auto_hide_count_down_activate" class="form-control">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="auto_hide_count_down_seconds" class="control-label col-md-2">Auto Hide Count Down Seconds</label>
                            <div class="col-md-3">
                                <select id="auto_hide_count_down_seconds" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="manual_hide_count_down_seconds" class="control-label col-md-2">Manual Hide Count Down Seconds</label>
                            <div class="col-md-3">
                                <select id="manual_hide_count_down_seconds" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <a id="add_advertisement" class="btn btn-warning btn-lg">Add</a>
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
<script src="/resources/manager/js/e_store/cms/advertisement/add_advertisement.js"></script>
<!-- END CUSTOMIZED LIB -->
