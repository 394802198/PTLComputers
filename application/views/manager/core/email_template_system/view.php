<!-- BEGIN HEADER -->
<?php include 'includes/manager/header.php'; ?>
<!-- END HEADER -->

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-danger">
				<div class="panel-heading">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li><a href="/manager" class="text-danger">Home</a></li>
                        <li><a href="/manager#core_panel" class="text-danger">Core</a></li>
                        <li class="active">Email Template ( System )</li>
                        <li class="pull-right" id="breadcrumb-li">
                            <a href="/manager/core/email_template_system/add" class="btn btn-xs btn-danger">
                                <span class="glyphicon glyphicon-plus" ></span>
                                Add Email Template ( System )
                            </a>
                        </li>
                    </ol>
				</div>
				<table class="table">
					<thead >
						<tr>
							<th></th>
							<th>Subject</th>
							<th>Purpose</th>
							<th style="text-align:center;">Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $emailTemplates as $emailTemplate ) { ?>
						<tr class="">
							<td>&nbsp;</td>
							<td>
								<a href="/manager/core/email_template_system/edit/id/<?php echo $emailTemplate->id ?>" class="btn btn-xs btn-danger">
									<?php echo $emailTemplate->subject ?>
                                    <span class="glyphicon glyphicon-pencil" ></span>
								</a>
							</td>
                            <td>
                                <?php
                                        $purposes = array(
                                            /** EStore
                                             */
                                            100     =>  'EStore Register',
                                            101     =>  'EStore Forget Password',
                                            102     =>  'EStore Online Ordering',
                                            103     =>  'EStore Online Ordering With Payment',
                                            105     =>  'EStore Forget Account',
                                            /** Remarketing
                                             */
                                            200     =>  'Remarketing Register',
                                            201     =>  'Remarketing Forget Password',
                                            202     =>  'Remarketing Online Ordering',
                                            203     =>  'Remarketing Forget Account'
                                        );
                                ?>
                                <?php echo $purposes[ $emailTemplate->purpose ] ?>
                            </td>
							<td style="text-align:center;">
                                <a href="javascript:void(0);" data-name="delete_email_template_system" data-email-template-system-id="<?php echo $emailTemplate->id ?>" class="btn btn-sm btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
							</td>
						</tr>
                        <?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteEmailTemplateSystemModal" tabindex="-1" role="dialog" aria-labelledby="deleteEmailTemplateSystemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteEmailTemplateSystemModalLabel">Delete Email Template ( System )</h4>
      </div>
      <div class="modal-body">
        Sure to delete this Email Template ( System )?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteEmailTemplateSystemConfirm">Delete</button>
      </div>
    </div>
  </div>
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

<!-- BEGIN CUSTOMIZED LIB -->
<script src="/resources/manager/js/core/email_template_system/view_email_template_system.js"></script>
<!-- END CUSTOMIZED LIB -->
