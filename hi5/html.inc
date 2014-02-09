<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>#DrupalCampMumbai2014</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
  </head>
  <body>
    <div>
      <h2>Welcome to Hi5.</h2>

<p>This site is a basic showcase below github details</p>
<ul>
<li>New commit comment</li>
<li>New gist</li>
<li>New event</li>
<li>New pull requst</li>
<li>New notification</li>
<li>New commit</li>
<li>New issue</li>
</ul>
 <a href='./clearsessions.php'>clearing your session</a>.</p>

    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>
    <p>
      <pre>
        <?php print_r($content); ?>
      </pre>
    </p>

  </body>
</html>
