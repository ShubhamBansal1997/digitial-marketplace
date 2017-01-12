<?php
    if(empty($productdetails)) {
        redirect(base_url());
    }
?>
<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="theme_page">
								<div class="theme_panel_section">
										<h4 class="th_title">
										<?php echo $productdetails[0]['prod_name'];?>
										</h4>
										<div class="th_mini_status">
										<?php if(empty($analyticsData)) {
										    echo '<p style="text-align: center;font-size: 20px;color: red;"> No data is recorded yet.<br/> <a style= "text-decoration: none;" href="'.$basepath.$controller.'/view_products/'.$productdetails[0]['prod_uniqid'].'">RESET</a></p>';
										} else {

						// Sort and Arrange Data
            $ipaddArr = $deviceArr = $browserArr = $viewsArr = array();
            foreach($analyticsData as $sData) {
                array_push($viewsArr,$sData['prod_analysis_views']);

                $ip = $sData['prod_analysis_ipaddr'];
                if(isset($ipaddArr[$ip])) {
                    $curVal = $ipaddArr[$ip];
                    $ipaddArr[$ip] = $curVal + 1;
                }
                else {
                   $ipaddArr[$ip] = 1;
                }

                $dev = $sData['prod_analysis_device'];
                if(isset($deviceArr[$dev])) {
                    $curVal = $deviceArr[$dev];
                    $deviceArr[$dev] = $curVal + 1;
                }
                else {
                   $deviceArr[$dev] = 1;
                }

                $brow = $sData['prod_analysis_browser'];
                if(isset($browserArr[$brow])) {
                    $curVal = $browserArr[$brow];
                    $browserArr[$brow] = $curVal + 1;
                }
                else {
                   $browserArr[$brow] = 1;
                }
            }
										?>
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
												<div class="th_filter">
													<select name="pagetype">
														<option value=""> <?php echo $this->ts_functions->getlanguage('allpagetext','vendorboard','solo');?></option>
														<option value="Single" <?php echo ($pagetype == 'Single') ? 'selected' : '' ; ?>><?php echo $this->ts_functions->getlanguage('previewtext','userdashboard','solo');?></option>
														<option value="Live Demo" <?php echo ($pagetype == 'Live Demo') ? 'selected' : '' ; ?>><?php echo $this->ts_functions->getlanguage('livedemotext','vendorboard','solo');?></option>
													</select>
												</div>
												<a onclick="submit_sort_form();" class="btn theme_btn"><?php echo $this->ts_functions->getlanguage('gotext','vendorboard','solo');?></a>
											</form>
											</div>
											<div class="">
												<div class="th_status_wrapper">
													<a href="#" class="th_icon yellow"><i class="fa fa-desktop" aria-hidden="true"></i></a>
													<div class="th_status">
														<strong><?php echo $this->ts_functions->getlanguage('uniqdevitext','vendorboard','solo');?></strong>
														<h6><?php echo count($deviceArr); ?></h6>
													</div>
												</div>
												<div class="th_status_wrapper">
													<a href="#" class="th_icon pink"><i class="fa fa-edge" aria-hidden="true"></i></a>
													<div class="th_status">
														<strong><?php echo $this->ts_functions->getlanguage('uniqbrowtext','vendorboard','solo');?></strong>
														<h6><?php echo count($browserArr); ?></h6>
													</div>
												</div>
												<div class="th_status_wrapper">
													<a href="#" class="th_icon green"><i class="fa fa-user-secret" aria-hidden="true"></i></a>
													<div class="th_status">
														<strong><?php echo $this->ts_functions->getlanguage('uniqiptext','vendorboard','solo');?></strong>
														<h6><?php echo count($ipaddArr); ?></h6>
													</div>
												</div>
												<div class="th_status_wrapper">
													<a href="#" class="th_icon gray"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<div class="th_status">
														<strong><?php echo $this->ts_functions->getlanguage('totviewstext','vendorboard','solo');?></strong>
														<h6><?php echo array_sum($viewsArr); ?></h6>
													</div>
												</div>

												<div class="th_status_wrapper">
													<a href="#" class="th_icon blue"><i class="fa fa-eye" aria-hidden="true"></i></a>
													<div class="th_status">
														<strong><?php echo $this->ts_functions->getlanguage('downloadssubheading','singleproductpage','solo');?> <br/><sub>(<?php echo $this->ts_functions->getlanguage('indepenfiltertext','vendorboard','solo');?> )</sub></strong>
														<h6><?php echo count($prodDownloads); ?></h6>
													</div>
												</div>

											</div>
										<?php } ?>
										</div>

									<?php if(!empty($analyticsData)) { ?>
									<div class="th_content_section">

										<div class="th_chart_wrapper">
											<div class="row">
												<div class="col-lg-6 col-md-6">
													<div class="th_chart_content">
														<h4><?php echo $this->ts_functions->getlanguage('prodviewdevicetext','vendorboard','solo');?></h4>
														<div id="device_chart"></div>
														<div class="th_chart_info">
															<!--<ul>
																<li><span class="pink"></span>data A</li>
																<li><span class="yellow"></span>data B</li>
															</ul>-->
														</div>
													</div>
												</div>

												<div class="col-lg-6 col-md-6">
													<div class="th_chart_content">
														<h4><?php echo $this->ts_functions->getlanguage('prodviewbrowsertext','vendorboard','solo');?></h4>
														<div id="browser_chart"></div>
														<div class="th_chart_info">
															<!--<ul>
																<li><span class="pink"></span>data A</li>
																<li><span class="yellow"></span>data B</li>
															</ul>-->
														</div>
													</div>
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
<?php $colorArray = array('#ec8597','#ffd06c','#20a1c2','#abd86b','#71fdb0','#795548','#ff5722');?>
<script>
Morris.Donut(
    {
        element: 'device_chart',
        data: [<?php foreach($deviceArr as $key=>$value) {
                echo '{value:'.$value.', label: "'.$key.'"},';
             } ?>],
        backgroundColor: '#fff',
        labelColor: '#6f5499',
        resize: true,
        colors: [
            <?php for($i=0;$i<count($deviceArr);$i++) {
                echo '"'.$colorArray[$i].'",';
             } ?>],
        formatter: function (x) { return x }
    }
);
Morris.Donut(
    {
        element: 'browser_chart',
        data: [<?php foreach($browserArr as $key=>$value) {
                echo '{value:'.$value.', label: "'.$key.'"},';
             } ?>],
        backgroundColor: '#fff',
        labelColor: '#2196f3',
        resize: true,
        colors: [
            <?php for($i=0;$i<count($browserArr);$i++) {
                echo '"'.$colorArray[$i].'",';
             } ?>],
        formatter: function (x) { return x }
    }
);
</script>
