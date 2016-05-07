<ul class="col-md-3">
    <li class="text-right">
        <link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/left_side.css" />
        <link href="<?php echo ROOT_PATH ?>/resources/global/FC_select_list/fc-select-list.css" rel="stylesheet" type="text/css">

        <div class="fb-like-box fb_iframe_widget" data-href="https://www.facebook.com/pages/PTLComputers/174204172623976" data-width="233" data-show-faces="true" data-stream="false" data-header="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=&amp;container_width=233&amp;header=true&amp;href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FPTLComputers%2F174204172623976&amp;locale=en_US&amp;sdk=joey&amp;show_faces=true&amp;stream=false&amp;width=233">
        <span style="vertical-align:bottom; width:218px; height:230px;">
            <iframe name="f11f573804" width="218px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like_box Facebook Social Plugin" src="http://www.facebook.com/plugins/like_box.php?app_id=&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FTlA_zCeMkxl.js%3Fversion%3D41%23cb%3Df29b3e8e8c%26domain%3Dwww.ptlcomputers.com%26origin%3Dhttp%253A%252F%252Fwww.ptlcomputers.com%252Ff37584a24%26relation%3Dparent.parent&amp;container_width=218&amp;header=true&amp;href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FPTLComputers%2F174204172623976&amp;locale=en_US&amp;sdk=joey&amp;show_faces=true&amp;stream=false&amp;width=218" style="border: none; visibility: visible; width: 218px; height: 230px;" class=""></iframe>
        </span>
        </div>

        <form class="form-horizontal">
            <div style="width:218px;" class="side_search_div">
                <div style="margin-bottom:15px;">
                    <select class="form-control" id="search_type" data-search>
                        <option value="">All Types</option>
                        <?php foreach( $types as $type ) { ?>
                            <option value="<?php echo $type->name ?>" ><?php echo $type->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div style="margin-bottom:15px;">
                    <select class="form-control" id="search_manufacturer" data-search>
                        <option value="">All Manufacturers</option>
                        <?php foreach( $manufacturers as $manufacturer ) { ?>
                            <option value="<?php echo $manufacturer->manufacturer ?>" ><?php echo $manufacturer->manufacturer ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div style="margin-bottom:15px;">
                    <select class="form-control" id="search_price" data-search>
                        <option value="">All Prices</option>
                        <option value="0-100">0-100</option>
                        <option value="101-200">101-200</option>
                        <option value="201-400">201-400</option>
                        <option value="401-600">401-600</option>
                        <option value="601-800">601-800</option>
                        <option value="801-1000">801-1000</option>
                        <option value=">1000">>1000</option>
                    </select>
                </div>
                <div style="margin-bottom:15px;">
                    <a class="btn btn-md btn-block btn-primary" id="search_product_btn">
                        Search
                        &nbsp;
                        <i class="fa fa-search"></i>
                    </a>
                    <a href="<?php echo ROOT_PATH ?>/e_store/commodity/search" class="btn btn-md btn-block btn-default">
                        Reset
                        &nbsp;
                        <i class="fa fa-refresh"></i>
                    </a>
                </div>
            </div>
        </form>

        <ul class="xl-show" style="background:#434343; padding:0; width:218px; margin-left:45px; margin-top:15px; margin-bottom:15px;">

            <?php
            $typeParam = '';
            $manufacturerParam = '';
            $priceRangeParamAppend = '';
            if ( isset( $_GET['type'] ) )
            {
                $typeParam .= $_GET['type'];
            }
            if ( isset( $_GET['manufacturer'] ) )
            {
                $manufacturerParam .= $_GET['manufacturer'];
            }
            if ( isset( $_GET['price_range'] ) )
            {
                $priceRangeParamAppend .= '&price_range=' . $_GET['price_range'];
            }
            ?>
            <?php foreach( $types as $type ) { ?>
                <hr style="margin:0;"/>
                <li class="side_dropdown_li <?php echo strcasecmp( $type->name, $typeParam )==0 ? 'active' : '' ?>">
                    <a href="javascript:void(0);" class="side_dropdown_a" data-drop-product-type="<?php echo $type->name ?>" style="font-size:14px;">
                        <?php echo $type->name ?>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="side_dropdown_menu" data-drop-product-type="<?php echo $type->name ?>" data-is-dropped="<?php echo strcasecmp( $type->name, $typeParam )==0 ? 'true' : 'false' ?>">
                        <hr style="margin:0; border-color:#5a5a5a;"/>
                        <?php if( count( $type->manufacturerObjects ) > 1 ) { ?>
                            <li class="<?php echo strcasecmp( $type->name, $typeParam )==0 && ! $manufacturerParam ? 'active' : '' ?>">
                                <a href="<?php echo ROOT_PATH ?>/e_store/commodity/search?type=<?php echo $type->name . $priceRangeParamAppend ?>">All</a>
                            </li>
                        <?php } ?>
                        <?php foreach( $type->manufacturerObjects as $manufacturerObject ) { ?>
                            <?php $is_selected = strcasecmp( $type->name, $typeParam )==0 && strcasecmp( $manufacturerObject->manufacturer, $manufacturerParam )==0 ? true : false ?>
                            <li class="<?php echo $is_selected ? 'active' : '' ?>">
                                <a <?php echo $is_selected ? 'href="javascript:void(0);"' : 'href="' . ROOT_PATH . '/e_store/commodity/search?type=' . $type->name . '&manufacturer=' . $manufacturerObject->manufacturer . $priceRangeParamAppend . '"' ?> class="side_dropdown_inner_a" style="font-size:12px;">
                                    <?php echo $manufacturerObject->manufacturer ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <hr style="margin:0;"/>

        </ul>

    </li>
</ul>