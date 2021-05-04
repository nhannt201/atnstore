	<header class="blog-header py-3">
			<div class="row flex-nowrap justify-content-between align-items-center">
			  <div class="col-4 pt-1">
				<div class="text-muted">Phone support: <a href="tel:01234566789">0522789234</a></div>
			  </div>
			  <div class="col-4 text-center" id="search_form">
			   <a class="blog-header-logo text-dark" href="/">ATN Toy Store</a>
			  </div>
			  <div class="col-4 d-flex justify-content-end align-items-center">
				<span  onClick="clickSearch()" aria-label="Search">
				  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
				</span>
				  <?php if (isset($_SESSION["login_ad"])) {?>
				<!--<a class="btn btn-sm btn-outline-secondary" href="/admin.html">Admin Panel</a>	&nbsp;	&nbsp;-->
				  <?php } include("inc/cart.php");?>
				 
				
			  </div>
			</div>
		  </header>
		  	<!--Choose address-->
					<?php require_once './inc/config.php';
						$d_b = new Get();
					if (!isset($_SESSION['store_id'])) { ?>
						<script type="text/javascript">
						$(window).on('load', function() {
							$('#chooseBranch').modal('show');
						});
					</script>
					<?php } ?>
						<!-- Modal -->
						  <div class="modal fade" id="chooseBranch" role="dialog" data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog">
							
							  <!-- Modal content-->
							  <div class="modal-content">
								<div class="modal-header">
								  <h4 class="modal-title">Select a branch near you</h4>
								</div>
								<div class="modal-body">
								 <?=$d_b->getBranch();?>
								</div>
								<div class="modal-footer">
								  <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="chooseBranch();" >Choose</button>
								</div>
							  </div>
							  
							</div>
						  </div>
						<!--EndChoosse-->