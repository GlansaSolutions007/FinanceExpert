<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title><?= lang('Errors.whoops') ?></title>

    <style>
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>
</head>
<body>

    <div class="container text-center">

        <h1 class="headline">Some error occurs</h1>

        <p class="lead">May be you entered wrong data click below link to go back</p>
        <a class="lead" href="https://wwh.live/test/admin/uploadmaster">Go back</a>
    </div>

</body>

</html>
