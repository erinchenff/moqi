<?php

namespace Lhjx\Phabot\Conduit;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private $httpClient;
    private $baseUri;
    private $conduitToken;

    public function __construct($baseUri, $conduitToken)
    {
        $this->baseUri = $baseUri;
        $this->conduitToken = $conduitToken;
    }

    public function request($endpoint, array $params = [])
    {
        if (!$this->isEndpointSupported($endpoint)) {
            throw new \Exception(sprintf('Unsupported endpoint: "%s"', $endpoint));
        }

        $params['api.token'] = $this->conduitToken;

        $res = $this->getHttpTransport()->request('POST', 'api/'.$endpoint, [
            'form_params' => $params,
        ]);

        return $this->parseResponse($res);
    }

    /**
     * TODO 应检查是否是search接口
     */
    public function paginate($endpoint, array $params = [])
    {
        return new Pagination($this, $endpoint, $params);
    }

    protected function getHttpTransport()
    {
        if (null === $this->httpClient) {
            $this->httpClient = new GuzzleClient([
                'base_uri' => $this->baseUri,
            ]);
        }

        return $this->httpClient;
    }

    private function parseResponse($res)
    {
        $json = $res->getBody()->getContents();

        $data = json_decode($json, true);

        if (!is_array($data)) {
            throw new \Exception('malformed_response');
        }

        foreach (['result', 'error_code', 'error_info'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new \Exception('Malformed response');
            }
        }

        if (null !== $data['error_code']) {
            throw new \Exception($data['error_info']);
        }

        return $data['result'];
    }

    private function isEndpointSupported($endpoint)
    {
        return in_array($endpoint, [
            'maniphest.search',
        ]);
    }
}
