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
            <?php if( strcasecmp( $page['is_page_title_visible'], 'Y' )==0 ) { ?>
                <?php

                    $title_alignment = '';
                    switch( $page['page_title_alignment'] )
                    {
                        case 100 : $title_alignment = 'text-left'; break;
                        case 101 : $title_alignment = 'text-center'; break;
                        case 102 : $title_alignment = 'text-right'; break;
                    }
                    $title_entity = '';
                    switch( $page['page_title_size'] )
                    {
                        case 100 : $title_entity .= '<h1 class="' . $title_alignment . '">' . $page['page_title'] . '</h1>'; break;
                        case 101 : $title_entity .= '<h2 class="' . $title_alignment . '">' . $page['page_title'] . '</h2>'; break;
                        case 102 : $title_entity .= '<h3 class="' . $title_alignment . '">' . $page['page_title'] . '</h3>'; break;
                        case 103 : $title_entity .= '<h4 class="' . $title_alignment . '">' . $page['page_title'] . '</h4>'; break;
                        case 104 : $title_entity .= '<h5 class="' . $title_alignment . '">' . $page['page_title'] . '</h5>'; break;
                    }

                    echo $title_entity;

                ?>
            <?php } ?>
            <?php echo rawurldecode( $page['page_content'] ) ?>
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
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/home.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/wish_list.js"></script>
<!-- END CUSTOMIZED LIB -->

<!-- BEGIN CUSTOMIZED LIB -->
<script src="<?php echo ROOT_PATH ?>/resources/e_store/js/cart.js"></script>
<!-- END CUSTOMIZED LIB -->