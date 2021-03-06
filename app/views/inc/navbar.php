

<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="<?php echo URLROOT; ?>">Home</a></li>
        <li><a href="<?php echo URLROOT; ?>/pages/about">About</a></li>        
      </ul>      
      <ul class="nav navbar-nav navbar-right">
        <?php if (isset($_SESSION['user_id'])):  ?>
        <li class=""><a href="#">Welcome <?php echo $_SESSION['user_name']; ?></a></li>
        <li class=""><a href="<?php echo URLROOT; ?>/users/logout">Logout</a></li>
        <?php else: ?>
        <li class=""><a href="<?php echo URLROOT; ?>/users/register">Register</a></li>
        <li><a href="<?php echo URLROOT; ?>/users/login">Login</a></li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>