<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="theme_page">
								<div class="theme_panel_section">
										<h4 class="th_title"><?php echo $this->ts_functions->getlanguage('welcometext','vendorboard','solo');?>
										</h4>
										<div class="th_mini_status">

											<div class="th_filter_wrapper">
											<form action="" method="post" id="sort_form">

												<div class="th_filter">
												<label><?php echo $this->ts_functions->getlanguage('filtertext','vendorboard','solo');?> </label>
													<select name="duration" onchange="displayDate(this)">
														<option value=""><?php echo $this->ts_functions->getlanguage('alltext','homepage','solo');?></option>

														<option value="today" <?php echo ($duration == 'today') ? 'selected' : '' ; ?>><?php echo $this->ts_functions->getlanguage('todaytext','vendorboard','solo');?></option>

														<option value="yesterday" <?php echo ($duration == 'yesterday') ? 'selected' : '' ; ?>><?php echo $this->ts_functions->getlanguage('yesterdaytext','vendorboard','solo');?></option>

														<option value="custom" <?php echo ($duration == 'custom') ? 'selected' : '' ; ?>><?php echo $this->ts_functions->getlanguage('customtext','vendorboard','solo');?></option>
													</select>
												</div>
												<div class="th_datepicker" <?php echo ($duration != 'custom') ? 'style="display:none;"' : '' ; ?>>
													<input type="text" class="form-control datepicker" placeholder="dd/mm/yyyy" name="d1" value="<?php echo ($duration == 'custom') ? $d1 : '' ; ?>"> <?php echo $this->ts_functions->getlanguage('totext','vendorboard','solo');?>
													<input type="text" class="form-control datepicker" placeholder="dd/mm/yyyy" name="d2" value="<?php echo ($duration == 'custom') ? $d2 : '' ; ?>">
												</div>
												<a onclick="submit_sort_form();" class="btn theme_btn"><?php echo $this->ts_functions->getlanguage('filterw','vendorboard','solo');?></a>
											</form>
											</div>
											<div class="">

        <?php
            $deviceArr = $browserArr = $viewsArr = array();
            if(!empty($prodViews)) {
                foreach($prodViews as $vData) {
                    array_push($viewsArr,$vData['prod_analysis_views']);

                    // Device
                    $dev = $vData['prod_analysis_device'];
                    if(isset($deviceArr[$dev])) {
                        $curValArr = explode(',',$deviceArr[$dev]);
                        $curVal_prev = $curValArr[0];
                        $curVal_demo = $curValArr[1];
                        if( $vData['prod_analysis_pagetype'] == 'Single' ){
                            $cPrev = 1;
                            $cDemo = 0;
                        }
                        else {
                            $cPrev = 0;
                            $cDemo = 1;
                        }
                        $curVal_prev = $curValArr[0] + $cPrev;
                        $curVal_demo = $curValArr[1] + $cDemo;
                        $deviceArr[$dev] = $curVal_prev.','.$curVal_demo;
                    }
                    else {
                        if( $vData['prod_analysis_pagetype'] == 'Single' ){
                            $deviceArr[$dev] = '1,0';
                        }
                        else {
                            $deviceArr[$dev] = '0,1';
                        }
                    }

                    // Browsers
                    $brow = $vData['prod_analysis_browser'];
                    if(isset($browserArr[$brow])) {
                        $curValArr = explode(',',$browserArr[$brow]);
                        $curVal_prev = $curValArr[0];
                        $curVal_demo = $curValArr[1];
                        if( $vData['prod_analysis_pagetype'] == 'Single' ){
                            $cPrev = 1;
                            $cDemo = 0;
                        }
                        else {
                            $cPrev = 0;
                            $cDemo = 1;
                        }
                        $curVal_prev = $curValArr[0] + $cPrev;
                        $curVal_demo = $curValArr[1] + $cDemo;
                        $browserArr[$brow] = $curVal_prev.','.$curVal_demo;
                    }
                    else {
                        if( $vData['prod_analysis_pagetype'] == 'Single' ){
                            $browserArr[$brow] = '1,0';
                        }
                        else {
                            $browserArr[$brow] = '0,1';
                        }

                    }
                }
            }
            $tot_prod_views = array_sum($viewsArr);
        ?>
												<div class="th_status_wrapper">
													<a href="#" class="th_icon green"><i class="fa fa-folder" aria-hidden="true"></i></a>
													<div class="th_status">
														<strong><?php echo $this->ts_functions->getlanguage('activeprodtext','vendorboard','solo');?></strong>
														<h6><?php echo count($productdetails_active); ?></h6>
													</div>
												</div>

												<div class="th_status_wrapper">
													<a href="#" class="th_icon blue"><i class="fa fa-folder-open" aria-hidden="true"></i></a>
													<div class="th_status">
														<strong><?php echo $this->ts_functions->getlanguage('freeprodtext','vendorboard','solo');?></strong>
														<h6><?php echo count($productdetails_free); ?></h6>
													</div>
												</div>

												<div class="th_status_wrapper">
													<a href="#" class="th_icon skyblue"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<div class="th_status">
														<strong> <?php echo $this->ts_functions->getlanguage('totprodviewstext','vendorboard','solo');?> </strong>
														<h6><?php echo $tot_prod_views; ?></h6>
													</div>
												</div>
												<div class="th_status_wrapper">
													<a href="#" class="th_icon teal"><i class="fa fa-money" aria-hidden="true"></i></a>
													<div class="th_status">
														<strong><?php echo $this->ts_functions->getlanguage('totprodsalestext','vendorboard','solo');?> </strong>
														<h6><?php echo count($prodSales); ?></h6>
													</div>
												</div>

											</div>
										</div>

									<div class="th_content_section">

										<div class="th_chart_wrapper">

											<div class="row">
												<div class="col-lg-6 col-md-6">
													<div class="th_chart_content">
														<h4><?php echo $this->ts_functions->getlanguage('prodviewdevicetext','vendorboard','solo');?> </h4>
														<?php if(!empty($deviceArr)) { ?>
														<div id="device_chart"></div>
														<?php } else {
														    echo '<p style="text-align: center;color: red;height:48px;">Nothing is fetched yet.</p>';
														} ?>
													</div>
												</div>

												<div class="col-lg-6 col-md-6">
													<div class="th_chart_content">
														<h4><?php echo $this->ts_functions->getlanguage('prodviewbrowsertext','vendorboard','solo');?> </h4>
														<?php if(!empty($browserArr)) { ?>
														<div id="browser_chart"></div>
														<?php } else {
														    echo '<p style="text-align: center;color: red;height:48px;">Nothing is fetched yet.</p>';
														} ?>
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
			</div>
		</div>
		<!-- user content section -->
	</div>
</div>
<!-- content section end -->
<input type="hidden" id="basepath" value="<?php echo $basepath;?>" />
<!--Script_start-->
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/jquery-1.12.3.js"></script>
<script src="<?php echo $basepath;?>adminassets/js/plugins/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo $basepath;?>adminassets/js/plugins/morris.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/smoothscroll.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/wow.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/bootstrap-datepicker.js"></script>
<script src="<?php echo $basepath;?>adminassets/js/admin_custom.js" type="text/javascript"></script>
</body>
</html>
<?php $colorArray = array('#ff5722','#795548','#4caf50','#abd86b','#71fdb0','#ff4400','#29b6f6','#009688','#DAF7A6');?>
<script>
$( document ).ready(function() {
    <?php if(!empty($deviceArr)) { ?>
    Morris.Bar({
      element: 'device_chart',
      data: [<?php foreach($deviceArr as $key=>$value) {
            $vArr = explode(',',$value);
            echo '{y: "'.$key.'" , a: '.$vArr[0].' , b: '.$vArr[1].'},';
         } ?>
      ],
      xkey: 'y',
      ykeys: ['a','b'],
      resize: true,
      labels: ['Preview', 'Live Demo'],
      barColors : ['#5ab2cc','#ffa000']
    });
    <?php } ?>

    <?php if(!empty($browserArr)) { ?>
    Morris.Bar({
      element: 'browser_chart',
      data: [<?php foreach($browserArr as $key=>$value) {
            $vArr = explode(',',$value);
            echo '{y: "'.$key.'" , a: '.$vArr[0].' , b: '.$vArr[1].'},';
         } ?>
      ],
      xkey: 'y',
      ykeys: ['a','b'],
      resize: true,
      labels: ['Preview', 'Live Demo'],
      barColors : ['#d7da14','#2196f3']
    });
    <?php } ?>

});
</script>
