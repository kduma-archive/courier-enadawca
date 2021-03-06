<?php
namespace Sylapi\Courier\Enadawca\Message;

/**
 * Class getPrintForParcel
 * @package Sylapi\Courier\Enadawca\Message
 */
class getPrintForParcel
{
    /**
     * @var
     */
    private $data;
    /**
     * @var
     */
    private $response;

    /**
     * @param $parameters
     * @return $this
     */
    public function prepareData($parameters) {

        $this->data = array(
            'guid' => $parameters['custom_id'],
            'type' => [
                'kind' => 'ADDRESS_LABEL',
                'method' => 'EACH_PARCEL_SEPARATELY'
            ]
        );

        return $this;
    }

    /**
     * @param $client
     */
    public function call($client) {

        try {

            $result = $client->getPrintForParcel($this->data);

            if (isset($result->printResult->print)) {

                $this->response['return'] = $result->printResult->print;
            }
            else {

                $this->response['error'] = $result->error->errorDesc.'';
                $this->response['code'] = $result->error->errorNumber.'';
            }
        }
        catch (\SoapFault $e) {

            $this->response['error'] = $e->faultactor.' | '.$e->faultstring;
            $this->response['code'] = $e->faultcode.'';
        }
    }

    /**
     * @return |null
     */
    public function getResponse() {

        if (!empty($this->response['return'])) {
            return $this->response['return'];
        }
        return null;
    }

    /**
     * @return bool
     */
    public function isSuccess() {

        if (!empty($this->response['return']) && $this->getError() == '') {
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getError() {
        return (isset($this->response['error'])) ? $this->response['error'] : '';
    }

    /**
     * @return string
     */
    public function getCode() {
        return (isset($this->response['code'])) ? $this->response['code'] : '';
    }
}