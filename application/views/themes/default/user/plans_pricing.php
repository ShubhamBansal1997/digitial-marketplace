			<div class="ts_planinfo">
				<p><?php echo $this->session->flashdata('plan_message');?> </p>
			</div>
		</div>
		<?php
		    $userPlan = 0;
		    if(isset($this->session->userdata['ts_uid'])) {
		        $uid = $this->session->userdata['ts_uid'];
                $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$this->session->userdata('ts_uid')));
                $userPlan = $userDetail[0]['user_plans'];
		    }

		?>
		<?php if(empty($plandetails)) { redirect(base_url()); } ?>
			<div class="ts_pricing_table">
				<ul>
				<?php foreach($plandetails as $solo_plans) {
				    $uniqId = $solo_plans['plan_id'];
				?>

				    <li>
						<div class="ts_pricing_table_info <?php echo ( $uniqId == $userPlan ) ? 'active_tbl' : '' ; ?>">
							<div class="ts_pritable_title">
								<h4><?php echo $solo_plans['plan_name'];?></h4>
							</div>
							<div class="ts_pritable_price">
								<h1><sup><?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?></sup><?php echo $solo_plans['plan_amount'];?></h1>
							</div>
							<div class="ts_pritable_period">
								<p><?php echo $solo_plans['plan_duration'];?></p>
							</div>
							<?php
						if( $solo_plans['plan_features'] != '' ) {
						$featureArr = explode(PHP_EOL, $solo_plans['plan_features']); ?>
							<div class="ts_pritable_list">
								<ul>
							    <?php for($i=0;$i<count($featureArr);$i++) {
							         echo '<li>'.$featureArr[$i].'</li>';
							    } ?>
								</ul>
							</div>
							<?php } ?>
							<div class="ts_pritable_bnt">
						     <?php if( $uniqId == $userPlan ) { ?>
								<a class="ts_btn ts_disabled_btn"> <?php echo $this->ts_functions->getlanguage('upgradebtn','commontext','solo'); ?> </a>
							    <?php } else { ?>
							    <a href="<?php echo $basepath;?>shop/add_to_cart/plan/<?php echo $solo_plans['plan_id'];?>" class="ts_btn"> <?php echo $this->ts_functions->getlanguage('upgradebtn','commontext','solo'); ?> </a>
							    <?php } ?>
							</div>
						</div>
					</li>

				<?php } ?>

				</ul>
			</div>
		</div>
	</div>
</div>
<!-- Contact wrapper End -->
