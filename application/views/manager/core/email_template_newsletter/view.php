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
                        <li class="active">Email Template ( Newsletter )</li>
                        <li class="pull-right" id="breadcrumb-li">
                            <a href="/manager/core/email_template_newsletter/add" class="btn btn-xs btn-danger">
                                <span class="glyphicon glyphicon-plus" ></span>
                                Add Email Template ( Newsletter )
                            </a>
                        </li>
                    </ol>
				</div>
				<table class="table">
					<thead >
						<tr>
							<th></th>
							<th>Subject</th>
							<th style="text-align:center;">Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $emailTemplates as $emailTemplate ) { ?>
						<tr class="">
							<td>&nbsp;</td>
							<td>
								<a href="/manager/core/email_template_newsletter/edit/id/<?php echo $emailTemplate->id ?>" class="btn btn-sm btn-danger">
									<?php echo $emailTemplate->subject ?>
                                    <span class="glyphicon glyphicon-pencil" ></span>
								</a>
							</td>
							<td style="text-align:center;">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm" disabled>Send to Activated</button>
                                    <button type="button" class="btn btn-default btn-sm" disabled>EStore</button>
                                    <button type="button" data-name="send_to" data-type="e_store_customer" data-email-template-id="<?php echo $emailTemplate->id ?>" class="btn btn-warning btn-sm">Customers</button>
                                    <button type="button" data-name="send_to" data-type="e_store_subscriber" data-email-template-id="<?php echo $emailTemplate->id ?>" class="btn btn-warning btn-sm">Subscribers</button>
                                    <button type="button" class="btn btn-default btn-sm" disabled>Remarketing</button>
                                    <button type="button" data-name="send_to" data-type="remarketing_wholesaler" data-email-template-id="<?php echo $emailTemplate->id ?>" class="btn btn-info btn-sm">Wholesalers</button>
<!--                                    <button type="button" data-name="selected_commodities_on_off_shelf" data-type="off" class="btn btn-info btn-sm">Remarketing Subscriber</button>-->
                                </div><!-- /input-group -->
                                <a href="javascript:void(0);" data-name="delete_email_template_newsletter" data-email-template-newsletter-id="<?php echo $emailTemplate->id ?>" class="btn btn-sm btn-danger">
                                    &nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;
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
<div class="modal fade" id="sendEmailTemplateNewsletterToModal" tabindex="-1" role="dialog" aria-labelledby="sendEmailTemplateNewsletterToModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="sendEmailTemplateNewsletterToModalLabel">Send Email Template ( Newsletter ) To</h4>
            </div>
            <div class="modal-body">
                Sure to send this Email Template ( Newsletter ) to <span id="send_to_span_preview"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
                <button type="button" class="btn btn-danger" id="sendEmailTemplateNewsletterToConfirm">Send</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteEmailTemplateNewsletterModal" tabindex="-1" role="dialog" aria-labelledby="deleteEmailTemplateNewsletterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="deleteEmailTemplateNewsletterModalLabel">Delete Email Template ( Newsletter )</h4>
      </div>
      <div class="modal-body">
        Sure to delete this Email Template ( Newsletter )?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a minute</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteEmailTemplateNewsletterConfirm">Delete</button>
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
<script src="/resources/manager/js/core/email_template_newsletter/view_email_template_newsletter.js"></script>
<!-- END CUSTOMIZED LIB -->
