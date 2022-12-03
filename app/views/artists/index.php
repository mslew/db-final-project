<?php require APPROOT . '/views/inc/header.php'; ?>
  <?php /*flash('team_message');*/ ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Teams</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/artists/add" class="btn btn-primary">
       Add an Artist
      </a>
    </div>
  </div>
  <div class="list-group">
  <?php foreach($data['artists'] as $artist) : ?>
    <a href="<?php echo URLROOT; ?>/artists/show/<?php echo $artist->id; ?>" class="list-group-item list-group-item-action"><?php echo $artist->name; ?></a>
  <?php endforeach; ?>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>