<?php
menu_init();
?>
<div id="menu">
    <div id="menu-trigger"><span></span><span></span><span></span></div>
    <nav>
      <ul>
        <li><a href="./">ホームページTOP</a></li>
        <li><a href="solicitation.php">新歓情報</a></li>
        <li><a href="http://ameblo.jp/zermatt<?= h(ordSuffix(MANAGER_GRADE)) ?>/" target="_blank">ブログ</a></li>
        <li><a href="calendar.php">カレンダー</a></li>
        <li><a href="./#about">サークル紹介</a></li>
        <li><a href="event.php">企画紹介</a></li>
        <li><a href="./for_members/">メンバー用ページ</a></li>
        <li>
          <dl>
            <dt><a href="./#member">メンバー紹介</a></dt>
            <dd>
              <ul>
<?php
foreach($menu_grades as $menu_grade){
?>
                <li><a href="member.php?grade=<?= h($menu_grade['tag']) ?>"><?= h($menu_grade['label']) ?></a></li>
<?php
}
?>
              </ul>
            </dd>
        </li>
        <li><a href="./#link">リンク</a></li>
      </ul>
    </nav>
  </div>
