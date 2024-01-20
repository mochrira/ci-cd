<?php 

chdir(__DIR__.'/../');

$method = $_SERVER['REQUEST_METHOD'];
if($method == 'POST') {
    $tag = $_POST['tag'];
    echo shell_exec("git checkout tags/".$tag);
    die();
}

shell_exec("git fetch --tags");
$latestTag = shell_exec("git describe --tags \"$(git rev-list --tags --max-count=1)\"");
?>

<form action="update.php" method="POST">
    <input type="hidden" name="tag" value="<?php echo $latestTag; ?>">
    <h1>You are about to update app to version : <?php echo $latestTag; ?></h1>
    <button type="submit">Update Now</button>
</form>