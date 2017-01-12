<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Site_pagination{
		
	public function pagination($count, $CurrentPosition , $Limit = ""){
		$lmtPage = ($Limit != "")? $Limit : '10';
		
		$result = "";
		if(!empty($count) && $count > $lmtPage){
			# condition for hide pre button
			$preClass = ($CurrentPosition == '0')?'hide':'';
			
			$result .= '<ul>
				<li  data="0" title="First" class="pre '.$preClass.'"><a href="javascript:;" aria-label="Previous"><i class="fa fa-angle-left"></i></a></li>';    
				$cnt = 1;
				$chk = 0;	
				$li_val = '';
				$lastButonCont = 0;	
				for($i=0; $i<$count; $i = $i+$lmtPage){
						# condition for check active class
						if($CurrentPosition == $i){
							$cls = 'active';
							$check = 1;
							$li_val = $cnt;
						}else{
							$cls = '';
							$li_val = '<a href="javascript:;">'.$cnt.'</a>';
						}
							# condition for get 1 button after active class
							if(isset($check)){
								if($check == 3){
									$result .= '<li class="pagin_dot">...</li>';
									$nextActie = '';
								} 
								$check++;
							}
							
							$allNextBtnHideClass = (isset($nextActie))? 'hide' : '';
							
							# condition for get 1 button before active class
							if($CurrentPosition-($lmtPage*2) >= 0 && $i <= $CurrentPosition-($lmtPage*2)){
								if($chk == 0){
									$result .= '<li class="pagin_dot">...</li>';
									$chk++;
								}
								$hideClass = 'hide';
							}else{
								$hideClass = '';
							}
						# generate pagination button 
						$lastButonCont = $i;
						$result .= '<li data="'.$i.'" class="'.$allNextBtnHideClass.' '.$cls.' ' .$hideClass.'">'.$li_val.'</li>';
						$cnt++;
					}
				# condition for hide next button	
				$nextClass = ($CurrentPosition == ($i-$lmtPage))? 'hide' : '';
				
			return  $result .= '<li data="'.$lastButonCont.'" title="Last" class="next '.$nextClass.'"><a href="javascript:;" aria-label="Next"><i class="fa fa-angle-right"></i></a></li>
			</ul>';
		} 
	} # end function 
	
}	# end class 
 
?>