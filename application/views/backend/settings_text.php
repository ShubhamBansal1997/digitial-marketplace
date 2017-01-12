<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="theme_page">
								<div class="alert alert-info th_setting_text">
									<p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Just double click on any text to update that.</p>
								</div>
								<!-- <h3 class="th_title">add new user</h3> -->
								<div class="theme_panel_section">
									<div class="panel-group theme_panel" id="accordion" role="tablist" aria-multiselectable="true">
									<?php
									$allSectionsArr = explode(',',$this->ts_functions->getsettings('languagesection','text'));

									for($i=0;$i<count($allSectionsArr);$i++) {
									    $colpsIn = ( $i == 0 ) ? 'in' : '' ;

									    $closedSec = ( $i != 0 ) ? 'collapsed' : '' ;
									?>

										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="heading_<?php echo $i;?>">
												<h4 class="panel-title">
													<a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion_<?php echo $i;?>" aria-expanded="true" aria-controls="accordion_<?php echo $i;?>" class="<?php echo $closedSec;?>">
														<?php echo strtoupper($allSectionsArr[$i]);?>
													</a>
												</h4>
											</div>
											<div id="accordion_<?php echo $i;?>" class="panel-collapse collapse <?php echo $colpsIn; ?>" role="tabpanel" aria-labelledby="heading_<?php echo $i;?>">
												<div class="panel-body">

							<div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
								<?php
								$languageOptionsArr = explode(',', $this->ts_functions->getsettings('languageoption','text'));
								?>
									<thead>
										<tr>
											<th>#</th>
											<?php for($j=0;$j<count($languageOptionsArr);$j++) {
											    echo '<th>'.ucwords($languageOptionsArr[$j]).'</th>';
											}?>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<?php for($j=0;$j<count($languageOptionsArr);$j++) {
											    echo '<th>'.ucwords($languageOptionsArr[$j]).'</th>';
											}?>
										</tr>
									<tfoot>
							<?php $languageArr = $this->ts_functions->getlanguage('all',$allSectionsArr[$i],'all');
							    $counter = 0;

							?>
							    <tbody>
							<?php foreach($languageArr as $soloLang) {
							    $counter++;
							?>
                                <tr>
                                    <td><?php echo $counter; ?></td>

                                    <?php for($j=0;$j<count($languageOptionsArr);$j++) {
                                        $l = 'language_'.$languageOptionsArr[$j];
                                        echo '<td class="dblclicklang" data-id="'.$soloLang['language_key'].'#'.$allSectionsArr[$i].'#'.$languageOptionsArr[$j].'">'.$soloLang[$l].'</td>';
                                    }?>
                                </tr>
							<?php } ?>
                                </tbody>
								</table>
							</div>



												</div>
											</div>
										</div>

									<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- user content section -->
	</div>


<!-- Common modal start -->
<!-- Modal -->
<div class="modal fade theme_modal" id="commonLanguageModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Language Text</h4>
      </div>
      <div class="modal-body">
		  <div class="add_user_form">
			<div class="form-group">
				<div class="col-lg-12 col-md-12">
					<input type="text" class="form-control" id="langText">
				</div>
			</div>
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
        <button type="button" class="btn theme_btn languageUpdateBtn">Update</button>
      </div>
    </div>
  </div>
</div>
<!-- common modal start -->
