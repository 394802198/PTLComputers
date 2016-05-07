
<style>
    td[size="A4"] {
        background: white;
        width: 21cm;
        min-height: 29.7cm;
        display: block;
        margin: 0 auto;
        /*margin-bottom: 0.5cm;*/
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        padding: 10px;
    }
</style>
<table align="center">
    <tr>
        <td size="A4">
            <div style="float: left; display: inline-block; width: 46%;">
                <h2><?php echo $printTemplate['title'] ?></h2>
                <br/>
                <strong>Job Number: <?php echo $record['id'] ?></strong><br/>
                <strong>Customer Name: <?php echo $record['customer_name'] ?></strong><br/>
                <strong>Customer Phone: <?php echo $record['customer_phone'] ?></strong><br/>
                <strong>Customer Email: <?php echo $record['customer_email'] ?></strong><br/>
                <p style="margin: 0;">Item Name: <?php echo $record['item_name'] ?></p>
                <p style="margin: 0;">Item Model: <?php echo $record['item_model'] ?></p>
                <p style="margin: 0;">Item SN: <?php echo $record['item_sn'] ?></p>
                <br/><br/>
                <strong>Problem as Described by Customer:</strong>
                <p style="text-indent: 20px;">
                    <?php echo $record['problem_description'] ?>
                </p>
            </div>
            <div style="float: left; display: inline-block; width: 46%; text-align: center;">
                <img src="<?php echo isset($printTemplate['logo_img']) ? '/'.$printTemplate['logo_img'] : '/resources/global/image/default_img.svg' ?>" style="width:350px; height:60px;" />
                <br/><br/>
                <strong><?php echo $printTemplate['company_name'] ?></strong><br/>
                <p style="margin: 0;"><?php echo $printTemplate['company_street'] ?></p>
                <p style="margin: 0;"><?php echo $printTemplate['company_city'] ?></p>
                <br/>
                <p style="margin: 0;">Phone: <?php echo $printTemplate['phone'] ?></p>
            </div>
            <div style="float: left; width: 100%;">
                <br/>
                <strong>Term & Conditions :</strong>
                <p>
                    <?php echo urldecode($printTemplate['term_condition']) ?>
                </p>
            </div>
        </td>
    </tr>
</table>