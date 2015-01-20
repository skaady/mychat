<?php

class App {

    public function run() {        
        try {
            $oReq = Request::getInstance();
            $sControllerClass = $oReq->getRequestParam('cl', 'chat');
            $sAction = $oReq->getRequestParam('fnc', 'Index');

            $mRes = false;

            if (class_exists($sControllerClass)) {
                $oController = new $sControllerClass(Conf::getInstance());
                if (method_exists($oController, $sAction) && is_callable([$oController, $sAction])) {
                    $mRes = $oController->$sAction();
                }
            }

            if (!$mRes) {
                throw new Exception('Something wrong');
            } else {
                $this->_makeResponce($this->_renderView($oController, $mRes));
            }
        } catch (Exception $oEx) {
            $this->_handleException($oEx);
        }
    }

    protected function _handleException(Exception $oEx) {
        $this->_makeResponce($oEx->getMessage() . '<br /><a href="/" title="Back">Go back!</a>', false);
    }

    protected function _renderView(AbstractController $oController, $sViewName) {
        if (class_exists($sViewName)) {
            $oView = new $sViewName(Conf::getInstance());
            $oView->setViewData($oController->getViewData());

            return $oView->fetchTpl();
        }
    }

    protected function _makeResponce($sPageBody, $blStatus = true) {
        Session::getInstance()->set('sess_token', Session::getInstance()->get('new_sess_token'));

        header('Content-type: text/html; charset=UTF-8');

        if (Request::isAjax()) {
            echo json_encode([
                'content' => $sPageBody,
                'status'  => $blStatus
            ]);
        } else {
            echo $sPageBody;
        }

        die;
    }

}
