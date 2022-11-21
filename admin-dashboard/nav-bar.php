<div class="container">
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg scrolling-navbar double-nav pl-0">
		<!-- SideNav slide-out button -->
		<div class="float-left">
			<a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fas fa-bars"></i></a>
		</div>
		<!--Navbar links-->
 		 <div class="mr-auto">
        
		<ul class="nav navbar-nav nav-flex-icons ml-auto">			
			<li class="nav-item ">
				<a href="index.php"class="nav-link waves-effect"> <span class="clearfix d-none d-sm-inline-block text-dark"><i class="fas fa-home"></i>Home</span></a>
			</li>
			<!-- Dropdown -->
			<li class="nav-item dropdown notifications-nav">
				<a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false">
					<span class="d-none d-md-inline-block">Profile</span>
				</a>
				<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">					
					<a class="dropdown-item" href="admin_profile.php?admin-id=<?php echo $_SESSION["admin_id"]; ?>">          
						<span>My Profile</span>            
					</a>					
				</div>
			</li>
			<li class="nav-item dropdown notifications-nav">
				<a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false">
					<span class="d-none d-md-inline-block">Account</span>
				</a>
				<div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">					
					<a class="dropdown-item" href="password-update-form.php?admin-id=<?php echo $_SESSION["admin_id"]; ?>">          
						<span>Change Password</span>            
					</a>					
				</div>
			</li>
		</ul>
      </div>
		<!--/Navbar links-->
		<ul class="navbar-nav ml-auto pr-5 pt-0 mr-0">
			<li class="nav-item ml-0  mb-0">
				<a href="logout.php"><i class="fas fa-sign-in-alt fa-xs text-success"></i> <span class="text-info">Logout</span></a>			
			</li>
		</ul>	
		<!--/Navbar links-->
	</nav>
	<!-- /.Navbar -->
</div>	