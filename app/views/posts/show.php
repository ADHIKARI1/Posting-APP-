<?php require_once(APPROOT."/views/inc/header.php") ?>

<div class="row">
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fas fa-backward"></i> Back</a>
</div>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
	Wriiten by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>
<p><?php echo $data['post']->body; ?></p>
<?php if($data['post']->user_id == $_SESSION['user_id']): ?>
	<hr>
	<a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-primary">Edit</a>
	<form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
		<input type="submit" value="Delete" class=" pull-right btn btn-danger">
	</form>
<?php endif;  ?>

<?php require_once(APPROOT."/views/inc/footer.php") ?>