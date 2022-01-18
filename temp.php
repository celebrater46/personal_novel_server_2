<?php

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="Author" content="Enin Fujimi">
    <title>Test TXT To Array</title>
</head>
<body>
<h1>
    <a href="/">
        Test TXT To Array
    </a>
</h1>
<?php for ($i = 0; $i < $count; $i++) : ?>
    <?php echo "ID: " . $i . ", Title: " . $nove_list[$i][0] . ", Path: " . $nove_list[$i][1] . "<br>"; ?>
<?php endfor; ?>

<?php foreach ($data as $item) : ?>
    <?php foreach ($item as $item2) : ?>
        <p><?php echo "Episode: " . $item2["ep_id"] . ", Sub Title: " . $item2["chapter"]; ?></p>
    <?php endforeach; ?>
<?php endforeach; ?>

<?php foreach ($data as $item) : ?>
    <?php foreach ($item as $item2) : ?>
        <p><?php echo "Sub Title: " . $item2["chapter"]; ?></p>
    <?php endforeach; ?>
<?php endforeach; ?>



<?php foreach ($test_chapters as $item) : ?>
    <?php echo $item . "<br>" ?>
<?php endforeach; ?>



<?php foreach ($test_get_num_of_each_episodes as $item) : ?>
    <?php echo $item . "<br>" ?>
<?php endforeach; ?>



<?php foreach ($test_splited_array as $item) : ?>
    <p>--------------------------------</p>
    <?php foreach ($item as $chap) : ?>
        <?php echo $chap . "<br>" ?>
    <?php endforeach; ?>
<?php endforeach; ?>



<?php foreach ($test_array_chap_in_ep as $item) : ?>
    <p>--------------------------------</p>
    <h2><?php echo $item["episode"] ?></h2>
    <?php foreach ($item["chapters"] as $chapter) : ?>
        <?php echo $chapter . "<br>" ?>
    <?php endforeach; ?>
<?php endforeach; ?>

</body>
</html>
