        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="<?php echo burengoBaseUrl; ?>" class="dropdown-item">
            <i class="fas fa-th mr-2"></i> <?php echo burengo_portada; ?>
          </a>
          <div class="dropdown-divider"></div>		  
		  <a href="mis-publicaciones.php" class="dropdown-item">
            <i class="far fa-list-alt mr-2"></i>  <?php echo burengo_Mypost; ?>
          </a>		  
          <div class="dropdown-divider"></div>
          <a href="profile.php" class="dropdown-item">
            <i class="far fa-id-badge mr-2"></i> <?php echo burengo_Account; ?>    
          </a>
          <div class="dropdown-divider"></div>
          <a href="mail/inbox.php" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?php echo burengo_msg; ?>
          </a>
		 <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-favorites">
            <i class="fas fa-heart mr-2"></i> <?php echo burengo_seeFavs; ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="salir.php" class="dropdown-item"> <i class="fas fa-sign-out-alt text-danger mr-2"></i> <?php echo burengo_logout; ?> </a>
        </div>