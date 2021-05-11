<?php

?>
<style>
    <?php include '../views/style/style.css'?>
    <?php include '../views/style/page.css'?>
</style>
      
<div class="header">
    <a href="/" class="button button-bottom"><div>Backwards button</div></a>

    <div class="title"><a href="/">Shortener</a></div> 

    <div class="login-details"><a href="/?user=<?=$userName?>">User Img</a></div>
</div>
<p>Currently in development</p>
<div class="search-bar">
    <form action="" >
        <input type="text" class="inputBox" name="search" placeholder="Search">
        <input type="submit" value="*" class="inputButton">
    </form>
</div>
<div class="user-page">
    <div class="link-table">
        <div class="title">Current active links:</div>

        <?=$userLinks?>

        <div class="space"></div>
    </div>   
</div>

<script>
    <?php include "../scripts/test.js"?>
</script> 

