<?php
/**
 * Created by PhpStorm.
 * User: 李木子
 * Date: 2018/1/11
 * Time: 下午 4:57
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <base href="<?php echo site_url()?>">
</head>
<body>
<form action="user/update/<?php echo $user->id?>" method="post">
    name: <input type="text" name='username' value="<?php echo $user->name?>">
    <input type="submit">

</form>
</body>
</html>
