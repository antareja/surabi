<script src="http://localhost:8000/socket.io/socket.io.js"></script>
<div class="page-content">
	<div class="page-header">
		<h1>Fleet State Module</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-header">Results for "Latest Vehicle Fleet Status"</div>

			<div class="table-responsive">
				<table id="sample-table-2"
					class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="center"><label> <input type="checkbox" class="ace" />
									<span class="lbl"></span>
							</label></th>
							<th>Vehicle</th>
							<th>Speed</th>
							<th class="hidden-480">Location</th>

							<th><i class="icon-time bigger-110 hidden-480"></i>Position At</th>
							<th class="hidden-480">Status</th>

							<th></th>
						</tr>
					</thead>

					<tbody>
						<tr id="tr_00000000000000000000000320">
							<td class="center"><label> <input type="checkbox" class="ace" />
									<span class="lbl"></span>
							</label></td>

							<td><a href="#">Houling</a></td>
							<td id="speed_00000000000000000000000320">45</td>
							<td id="location_00000000000000000000000320" class="hidden-480">Near Bandung</td>
							<td id="position_00000000000000000000000320">Feb 12 10:45:23</td>

							<td class="hidden-480"><span class="label label-sm label-warning">Expiring</span>
							</td>

							<td>
								<div
									class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
									<a class="blue" href="#"> <i class="icon-zoom-in bigger-130"></i>
									</a> <a class="green" href="#"> <i
										class="icon-pencil bigger-130"></i>
									</a> <a class="red" href="#"> <i class="icon-trash bigger-130"></i>
									</a>
								</div>

								<div class="visible-xs visible-sm hidden-md hidden-lg">
									<div class="inline position-relative">
										<button class="btn btn-minier btn-yellow dropdown-toggle"
											data-toggle="dropdown">
											<i class="icon-caret-down icon-only bigger-120"></i>
										</button>

										<ul
											class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
											<li><a href="#" class="tooltip-info" data-rel="tooltip"
												title="View"> <span class="blue"> <i
														class="icon-zoom-in bigger-120"></i>
												</span>
											</a></li>

											<li><a href="#" class="tooltip-success" data-rel="tooltip"
												title="Edit"> <span class="green"> <i
														class="icon-edit bigger-120"></i>
												</span>
											</a></li>

											<li><a href="#" class="tooltip-error" data-rel="tooltip"
												title="Delete"> <span class="red"> <i
														class="icon-trash bigger-120"></i>
												</span>
											</a></li>
										</ul>
									</div>
								</div>
							</td>
						</tr>

						<tr id="tr_00000000000000000000000521">
							<td class="center"><label> <input type="checkbox" class="ace" />
									<span class="lbl"></span>
							</label></td>

							<td><a href="#">Dump Truck</a></td>
							<td id="speed_00000000000000000000000521">55</td>
							<td id="location_00000000000000000000000521"class="hidden-480">Near Cimahi</td>
							<td id="position_00000000000000000000000521">Feb 18 11:55</td>

							<td class="hidden-480"><span class="label label-sm label-success">Free</span>
							</td>

							<td>
								<div
									class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
									<a class="blue" href="#"> <i class="icon-zoom-in bigger-130"></i>
									</a> <a class="green" href="#"> <i
										class="icon-pencil bigger-130"></i>
									</a> <a class="red" href="#"> <i class="icon-trash bigger-130"></i>
									</a>
								</div>

								<div class="visible-xs visible-sm hidden-md hidden-lg">
									<div class="inline position-relative">
										<button class="btn btn-minier btn-yellow dropdown-toggle"
											data-toggle="dropdown">
											<i class="icon-caret-down icon-only bigger-120"></i>
										</button>

										<ul
											class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
											<li><a href="#" class="tooltip-info" data-rel="tooltip"
												title="View"> <span class="blue"> <i
														class="icon-zoom-in bigger-120"></i>
												</span>
											</a></li>

											<li><a href="#" class="tooltip-success" data-rel="tooltip"
												title="Edit"> <span class="green"> <i
														class="icon-edit bigger-120"></i>
												</span>
											</a></li>

											<li><a href="#" class="tooltip-error" data-rel="tooltip"
												title="Delete"> <span class="red"> <i
														class="icon-trash bigger-120"></i>
												</span>
											</a></li>
										</ul>
									</div>
								</div>
							</td>
						</tr>

						<tr id="tr_00000000000000000000000321">
							<td class="center"><label> <input type="checkbox" class="ace" />
									<span class="lbl"></span>
							</label></td>

							<td><a href="#">Car</a></td>
							<td id="speed_00000000000000000000000321">60</td>
							<td id="location_00000000000000000000000321"class="hidden-480">Near Garut</td>
							<td id="position_00000000000000000000000321">Apr 04 07:30</td>

							<td class="hidden-480"><span
								class="label label-sm label-info arrowed arrowed-righ">En Route</span>
							</td>

							<td>
								<div
									class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
									<a class="blue" href="#"> <i class="icon-zoom-in bigger-130"></i>
									</a> <a class="green" href="#"> <i
										class="icon-pencil bigger-130"></i>
									</a> <a class="red" href="#"> <i class="icon-trash bigger-130"></i>
									</a>
								</div>

								<div class="visible-xs visible-sm hidden-md hidden-lg">
									<div class="inline position-relative">
										<button class="btn btn-minier btn-yellow dropdown-toggle"
											data-toggle="dropdown">
											<i class="icon-caret-down icon-only bigger-120"></i>
										</button>

										<ul
											class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
											<li><a href="#" class="tooltip-info" data-rel="tooltip"
												title="View"> <span class="blue"> <i
														class="icon-zoom-in bigger-120"></i>
												</span>
											</a></li>

											<li><a href="#" class="tooltip-success" data-rel="tooltip"
												title="Edit"> <span class="green"> <i
														class="icon-edit bigger-120"></i>
												</span>
											</a></li>

											<li><a href="#" class="tooltip-error" data-rel="tooltip"
												title="Delete"> <span class="red"> <i
														class="icon-trash bigger-120"></i>
												</span>
											</a></li>
										</ul>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /.page-content -->
<script src="<?php echo base_url() ?>assets/js/fleet.js"></script>