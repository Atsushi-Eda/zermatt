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
                <li><a href="member.php?grade=b3"><?= h(ordSuffix(MANAGER_GRADE)) ?>(3年生幹部)</a></li>
<?php
if($show_b1){
?>
                <li><a href="member.php?grade=b1"><?= h(ordSuffix(MANAGER_GRADE + 2)) ?>(1年生)</a></li>
<?php
}
?>
                <li><a href="member.php?grade=b2"><?= h(ordSuffix(MANAGER_GRADE + 1)) ?>(2年生)</a></li>
                <li><a href="member.php?grade=b4"><?= h(ordSuffix(MANAGER_GRADE - 1)) ?>(4年生)</a></li>
                <li><a href="member.php?grade=m"><?= h(ordSuffix($oldest)) ?>~<?= h(ordSuffix(MANAGER_GRADE - 2)) ?>(上級生)</a></li>
              </ul>
            </dd>
        </li>
        <li><a href="./#link">リンク</a></li>
      </ul>
    </nav>
  </div>
