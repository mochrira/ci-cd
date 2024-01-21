<?php 

chdir(__DIR__.'/../');

$method = $_SERVER['REQUEST_METHOD'];
if($method == 'POST') {
    $tag = $_POST['tag'];
    echo exec("git pull origin refs/tags/".$tag);
    echo exec("git checkout tags/".$tag." -b tags-".$tag);
    die();
}

exec("git fetch --tags");
$latestTag = exec("git describe --tags \"$(git rev-list --tags --max-count=1)\"");
?>

<form action="update.php" method="POST">
    <input type="hidden" name="tag" value="<?php echo $latestTag; ?>">
    <h1>You are about to update app to version : <?php echo $latestTag; ?></h1>
    <button type="submit">Update Now</button>
</form>