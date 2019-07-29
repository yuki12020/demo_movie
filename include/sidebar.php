<?php
$side_list = "";
foreach($url_list as $key => $value){
    $side_list .= ($_SERVER["REQUEST_URI"] === $value[0]) ? '<li class="active">' : '<li>';
    $side_list .= '<a href="'.$value[0].'">';
    $side_list .= '<i class="'.$value[2].'"></i>';
    $side_list .= '<p>'.$value[1].'</p>';
    $side_list .= '</a></li>';
}
$html =<<<EOM
<div class="sidebar" data-color="purple" data-image="./../public/assets/img/sidebar-5.jpg">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="/index.php" class="simple-text">
                indexに戻る
            </a>
        </div>
        <ul class="nav">{$side_list}</ul>
    </div>
</div>
EOM;
return $html;