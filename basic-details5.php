<?php 
	include('head.php');
?>

<!--  end navbar -->
<section>
	<div class="container bootstrap snippets full-information">
		<div class="row">
		  <div class="col-xs-12 col-sm-6 col-sm-offset-3">
			  <h3 class="text-center">Please Add Your Location Details</h3>
				<div class="panel panel-body" style="box-shadow: 5px 5px 7px #ccc; border: 1px solid #ccc; padding: 41px 0px;">
					<div class="row">
						<div class="col-sm-offset-1 col-sm-10">
							<form role="form">
		    					
		    					<div class="form-group">
								  <label for="sel1">City <span>*</span></label>
								  <select class="form-control" id="sel1">
									<option>Muzaffarnagar</option>
									<option>Meerut</option>
									<option>Mathura</option>
									<option>Mumbai</option>
								  </select>
								</div>
			    				
			    				<div class="form-group">
								  <label for="sel1">State <span>*</span></label>
								  <select class="form-control" id="sel1">
									<option>Delhi</option>
									<option>Gujarat</option>
									<option>Punjab</option>
									 <option>Uttar Pradesh</option>
								  </select>
								</div>
								
		    					<div class="form-group">
								  <label for="sel1">Country <span>*</span></label> 
								  <select class="form-control" id="sel1">
									  <option>India</option>
									<option>US</option>
									<option>Canada</option>
								  </select>
								</div>
		    					<input type="submit" value="Save" class="btn btn-danger">&nbsp;&nbsp;&nbsp;
			    				<input type="submit" value="Continue" class="btn btn-danger">
			    		
			    			</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php 
	include('footer.php');
?>

