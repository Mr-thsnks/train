<?php if (!defined('THINK_PATH')) exit(); if(C('LAYOUT_ON')) { echo ''; } ?>
<!doctype html>
<html>
<head>
  <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800">
  <meta charset="utf-8">
  <!-- Always force latest IE rendering engine or request Chrome Frame -->
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <!-- Use title if it's in the page YAML frontmatter -->
</head>
<body>
<div class="container">
<!-- <div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="error-box">
      <div class="message-small">Whoa! What are you doing here?</div>
      <div class="message-big">404</div>
      <div cass="message-small">You are not where you're supposed to be</div>
      <div style="margin-top: 50px">
        <a class="btn btn-blue" href="../dashboard/dashboard.html">
            <i class="icon-arrow-left"></i> Back to dashboard
        </a>
      </div>
    </div>
  </div>
</div> -->
</div>
<script type="text/javascript">
    alert("<?php echo $message?>");
    var _href = "<?php echo($jumpUrl); ?>";
    location.href = _href;
</script>
</body>
</html>