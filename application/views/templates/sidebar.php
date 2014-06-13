<?php 
$sidebar = 'sidebar';
if($this->uri->segment(1) == 'map') {
	$sidebar = 'sidebar menu-min';
}
?>

<div class="<?php echo $sidebar?>" id="sidebar">
				<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="icon-signal"></i>
						</button>
						<button class="btn btn-info">
							<i class="icon-pencil"></i>
						</button>
						<button class="btn btn-warning">
							<i class="icon-group"></i>
						</button>
						<button class="btn btn-danger">
							<i class="icon-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span> <span class="btn btn-info"></span>

						<span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
					</div>
				</div>
				<!-- #sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active"><a href="<?php echo site_url()?>"> 
					<i class="icon-dashboard"></i> 
					<span class="menu-text"> Dashboard 
						<span class="badge badge-transparent tooltip-error" title="2&nbsp;Important&nbsp;Events">
							<i class="icon-warning-sign red bigger-130"></i>
						</span>
					</span>
							
					</a></li>


					<li class="active open"><a href="#" class="dropdown-toggle"> <i class="icon-truck"></i>
							<span class="menu-text"> Vehicles </span> <b
							class="arrow icon-angle-down"></b>
					</a>

						<ul class="submenu">
							<?php 
							$i = 0;
							foreach ($vehicles as $vec) {
// 							$icon_status = array(
// 											array("Active",""),
// 											array("Move","icon-road"),
// 											array("Expire","icon-eye-slash"),
// 											array("Home","icon-home"),
// 											array("Maintence","icon-wrench"),
// 											array("Warning","icon-warning"),
// 											array("Stop","icon-power-off"),
// 											array("Accidenct","icon-fire"),
// 											array("Rest","icon-coffe"),
// 											array("Food","icon-food"),
// 											array("Night","icon-food"),
// 											array("Watch","icon-eye"),
// 											array("Outarea","icon-eye"),
// 											array("Speed","icon-fighter-jet"),
// 										);
							$icon_status = array("icon-exchange","icon-road","icon-flag-checkered","icon-home","icon-wrench","icon-warning-sign"
											,"icon-power-off","icon-fire", "icon-coffee","icon-food","icon-moon","icon-eye-open",
											"icon-fighter-jet");
							$icon_hover = array("Active","Move","Expire","Home","Maintence","Warning"
									,"Stop","Accidenct", "Rest","Food","Night","Watch","Speed");
							$icon_color = array("green","blue","red","grey","red","red"
									,"orange","red", "green","purple","blue","red","red");
							$i++;
							?>
								<li>
								
									<div class="checkbox">
										<label>
											 <input class="ace cek" type="checkbox" name="car" id="marker_<?php echo $vec->gps_mobile_address?>" onclick="if(this.checked)add_filter(this.id);else remove_filter(this.id);"/> 
											 <span class="menu-text lbl" id="vehivle_<?php echo $vec->gps_mobile_address?>">
												 <img alt="" width="20" src="<?php echo base_url()."assets/uploads/icon_".$vec->icon_id.".".$vec->image_type?>">
												 <?php echo $vec->name;?>
												 <span class="badge badge-transparent tooltip-error" title="<?php echo $icon_hover[$i];?>">
													<i class="<?php echo $icon_status[$i];?> <?php echo $icon_color[$i];?> bigger-130"></i>
												</span>
											 </span>
										</label>
									</div>
								</li>
							<?php } ?>
						</ul></li>

<!-- 					<li><a href="#" class="dropdown-toggle"> <i class="icon-globe"></i> -->
<!-- 							<span class="menu-text"> Map </span> <b -->
<!-- 							class="arrow icon-angle-down"></b> -->
<!-- 					</a> -->
<!-- 						<ul class="submenu"> -->
<!-- 							<li><a href="tables.html"> <i class="icon-double-angle-right"></i> -->
<!-- 									Simple &amp; Dynamic -->
<!-- 							</a></li> -->

<!-- 							<li><a href="jqgrid.html"> <i class="icon-double-angle-right"></i> -->
<!-- 									Haidar -->
<!-- 							</a></li> -->
<!-- 							<li><a href="jqgrid.html"> <i class="icon-double-angle-right"></i> -->
<!-- 									jqGrid plugin -->
<!-- 							</a></li> -->
<!-- 						</ul></li> -->

<!-- 					<li><a href="#" class="dropdown-toggle"> <i class="icon-edit"></i> -->
<!-- 							<span class="menu-text"> Reports </span> <b -->
<!-- 							class="arrow icon-angle-down"></b> -->
<!-- 					</a> -->

<!-- 						<ul class="submenu"> -->
<!-- 							<li><a href="form-elements.html"> <i -->
<!-- 									class="icon-double-angle-right"></i> Form Elements -->
<!-- 							</a></li> -->

<!-- 							<li><a href="form-wizard.html"> <i -->
<!-- 									class="icon-double-angle-right"></i> Wizard &amp; Validation -->
<!-- 							</a></li> -->

<!-- 							<li><a href="wysiwyg.html"> <i class="icon-double-angle-right"></i> -->
<!-- 									Wysiwyg &amp; Markdown -->
<!-- 							</a></li> -->

<!-- 							<li><a href="dropzone.html"> <i class="icon-double-angle-right"></i> -->
<!-- 									Dropzone File Upload -->
<!-- 							</a></li> -->
<!-- 						</ul></li> -->
				</ul>
				<!-- /.nav-list -->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"
						data-icon1="icon-double-angle-left"
						data-icon2="icon-double-angle-right"></i>
				</div>

				<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
			</div>
			<div class="main-content">