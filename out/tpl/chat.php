<?php $this->_includeTpl('layout/top.php'); ?>

<div class="msg-list">
    <?php
    $iOldMessCount = Conf::getInstance()->getConfParam('iOldestMessCnt');
    $iMessCount = count($this->aMessages);

    for ($i = 0; $i < $iMessCount; $i++) :
        $oMsg = $this->aMessages[$i];
        $blFull = true;
        if ($iMessCount > $iOldMessCount && $iMessCount - $i <= $iOldMessCount) {
            $blFull = false;
        }

        $sMessBlock = '<div class="msg-block ' . ($oMsg->is_ajax ? 'ajax' : '') . '">';
        $sMessBlock .= '<div class="msg-title">';
        $sMessBlock .= '<div class="name">' . $oMsg->user->user_name . ($oMsg->is_ajax ? ' (Ajax)' : '') . '</div>';
        $sMessBlock .= '<div class="date">(' . $oMsg->created . ')</div>';
        $sMessBlock .= '</div>';
        $sMessBlock .= '<div class="msg-text">' . $oMsg->getMessText($blFull) . '</div>';
        $sMessBlock .= '</div>';

        ?>
        <?= $sMessBlock; ?>
    <?php endfor; ?>    
</div>
<div class="msg-form">
    <?php $this->_includeTpl('forms/sendmessage.php'); ?>
</div>

<?php $this->_includeTpl('layout/bottom.php'); ?>