<?php

?>
<style>
    <?php include '../views/style/form.css'?>
</style>
<a href="/" id="bg"></a>

<div class="formDiv">
    <div class="title formTitle">Login</div> 
    <div class="message"><?=$login_php?></div>
    <form method="POST" action="" >
        <div class="inputBox">
            <input type="text" name="login" onkeyup="this.setAttribute('value', this.value);" value="">
            <label for="login">Login</label>
        </div>
        <div class="inputBox">
            <input type="text" name="password" onkeyup="this.setAttribute('value', this.value);" value="">
            <label for="password">Password</label>
        </div> 
        <button type="submit" name="user" value="Log Me">Login</button>
        <a href="/"><button>Back</button></a>
    </form>
</div>
