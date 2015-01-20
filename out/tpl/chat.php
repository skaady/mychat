<?php $this->_includeTpl('layout/top.php'); ?>

<div class="msg-list">
    <?php
    $iOldMessCount = 0;
    $iMessCount = count($this->aMessages);

    foreach ($this->aMessages as $oMsg) :
        $blFull = false;
        if ($iOldMessCount < $iMessCount - $this->_oConf->getConfParam('iOldestMessCnt')) {
            $blFull = true;
        }

        $sMessBlock = '<div class="msg-block ' . ($oMsg->is_ajax ? 'ajax' : '') . '">';
        $sMessBlock .= '<div class="msg-title">';
        $sMessBlock .= '<div class="name">' . $oMsg->user->user_name . ($oMsg->is_ajax ? ' (Ajax)' : '') . '</div>';
        $sMessBlock .= '<div class="date">(' . $oMsg->created . ')</div>';
        $sMessBlock .= '</div>';
        $sMessBlock .= '<div class="msg-text">' . $oMsg->getMessText($blFull) . '</div>';
        $sMessBlock .= '</div>';

        $iOldMessCount++;
        ?>
        <?= $sMessBlock; ?>
    <?php endforeach; ?>    
</div>
<div class="msg-form">
    <?php $this->_includeTpl('forms/sendmessage.php'); ?>
</div>

<?php $this->_includeTpl('layout/bottom.php'); ?>