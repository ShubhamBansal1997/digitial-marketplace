<div class="main_body">
 		<!-- user content section -->

		<div class="theme_wrapper">
			<div class="container-fluid">
			    <div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="th_manage_user">
								<h3 class="th_title">Header Option</h3>
<?php
    $liveHeader = $this->ts_functions->getsettings('headers','active');
?>
								<div class="th_theme_view">
									<?php
                                    if(!empty($headerArr)) {
                                        for($i=0;$i<count($headerArr);$i++){ ?>
                                            <div class="th_one_fifth">
                                                <div class="th_theme_img">
                                                    <img src="<?php echo $basepath;?>adminassets/headers/<?php echo $headerArr[$i];?>.png" alt="<?php echo $headerArr[$i];?>" style="min-height: 117px;"/>
                                                    <div class="th_overlay_btn">

                            <?php $acUrl = $headerArr[$i] == $liveHeader  ? 'javascript:;' : $basepath.'backend/tp_headers/'.$headerArr[$i]; ?>

                                            <a href="<?php echo $acUrl;?>" class="btn theme_btn <?php echo $headerArr[$i] == $liveHeader ? 'active_btn' : 'deactive_btn'; ?>"> <?php echo $headerArr[$i] == $liveHeader ? 'Active' : 'Activate'; ?> </a>

                                            <a href="<?php echo $basepath;?>adminassets/headers/<?php echo $headerArr[$i];?>.png" target="_blank" class="btn theme_btn orange_btn">Preview</a>
                                                    </div>
                                                </div>
                                                <h3><?php echo $headerArr[$i];?></h3>
                                            </div>
                                    <?php }
                                    }
									?>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- user content section -->
	</div>
