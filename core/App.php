<?php

class App {

    /**
     * main method. Run application
     * 
     * @return string
     */
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

    /**
     * show error page
     * 
     * @param Exception $oEx catched exception
     * @return string
     */
    protected function _handleException(Exception $oEx) {
        $this->_makeResponce($oEx->getMessage() . '<br /><a href="/" title="Back">Go back!</a>', false);
    }

    /**
     * render page
     * 
     * @param AbstractController $oController controller object
     * @param string $sViewName View for rendering
     * @return string
     */
    protected function _renderView(AbstractController $oController, $sViewName) {
        if (class_exists($sViewName)) {
            $oView = new $sViewName(Conf::getInstance());
            $oView->setViewData($oController->getViewData());

            return $oView->fetchTpl();
        }
    }

    /**
     * send responce po browser
     * 
     * @param string $sPageBody page body
     * @param bool $blStatus status for ajax responce. false on failure
     * @return null
     */
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
