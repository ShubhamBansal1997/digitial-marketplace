<div class="main_body">
 		<!-- user content section -->

		<div class="theme_wrapper">
			<div class="container-fluid">
			    <div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="th_manage_user">
								<h3 class="th_title">Themes <span style="color:#6f5499;">( <b><?php echo count($themeList);?></b> )</span></h3>

								<div class="th_theme_view">
									<?php
                                    if(!empty($themeList)) {
                                        foreach($themeList as $soloTheme){ ?>
                                            <div class="th_one_fifth">
                                                <div class="th_theme_img">
                                                    <img src="<?php echo $basepath;?>themes/<?php echo $soloTheme['theme_name'];?>/<?php echo $soloTheme['theme_name'];?>.jpg" alt="<?php echo $soloTheme['theme_displayname'];?>"/>
                                                    <div class="th_overlay_btn">

                            <?php $acUrl = $soloTheme['theme_status'] == '1' ? 'javascript:;' : $basepath.'backend/tp_themes/'.$soloTheme['theme_id']; ?>

                                            <a href="<?php echo $acUrl;?>" class="btn theme_btn <?php echo $soloTheme['theme_status'] == '1' ? 'active_btn' : 'deactive_btn'; ?>"> <?php echo $soloTheme['theme_status'] == '1' ? 'Active' : 'Activate'; ?> </a>

                                            <a href="http://themeportal.kamleshyadav.in/themes/<?php echo $soloTheme['theme_name'];?>/" target="_blank" class="btn theme_btn orange_btn">Preview</a>
                                                    </div>
                                                </div>
                                                <h3><?php echo $soloTheme['theme_displayname'];?></h3>
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
