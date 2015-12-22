<!doctype html>
<html class='no-js' lang='<?= $lang ?>'>
<head>
    <meta charset='utf-8'/>
    <title><?= $title . $title_append ?></title>
    <?php if (isset($favicon)): ?>
        <link rel='icon' href='<?= $this->url->asset($favicon) ?>'/><?php endif; ?>
    <?php foreach ($stylesheets as $stylesheet): ?>
        <!-- Latest compiled and minified CSS -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
              integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
              crossorigin="anonymous">

        <link rel='stylesheet' type='text/css' href='<?= $this->url->asset($stylesheet) ?>'/>
    <?php endforeach; ?>
    <?php if (isset($style)): ?>
        <style><?= $style ?></style><?php endif; ?>
    <script src='<?= $this->url->asset($modernizr) ?>'></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
</head>

<body>


<?php if (isset($navbar)) echo $navbar ?>
<?php $this->views->render('navbar') ?>

<div class="container">
    <?php if (isset($main)) echo $main ?>
    <?php $this->views->render('main') ?>
</div>

<div id='footer'>
    <?php if (isset($footer)) echo $footer ?>
    <?php $this->views->render('footer') ?>


    <?php if (isset($jquery)): ?>
        <script src='<?= $this->url->asset($jquery) ?>'></script><?php endif; ?>

    <?php if (isset($javascript_include)): foreach ($javascript_include as $val): ?>
        <script src='<?= $this->url->asset($val) ?>'></script>
    <?php endforeach; endif; ?>

    <?php if (isset($google_analytics)): ?>
        <script>
            var _gaq = [['_setAccount', '<?=$google_analytics?>'], ['_trackPageview']];
            (function (d, t) {
                var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
                g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
                s.parentNode.insertBefore(g, s)
            }(document, 'script'));
        </script>
    <?php endif; ?>

</body>
</html>
