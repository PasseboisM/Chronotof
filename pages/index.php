<?php
if (isset($cookieValide) || isset($sessionValide)){
    header('location: index.php?page=frise');
}