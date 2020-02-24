<?php
namespace Dcblogdev\Eventbrite;

use Exception;

class Curl
{
    private $baseUrl;

    public function __construct($baseUrl = '')
    {
        $this->baseUrl = $baseUrl;
    }

    public function __call($function, $args)
    {
        $options = ['get', 'post', 'patch', 'put', 'delete'];
        $path = (isset($args[0])) ? $args[0] : null;
        $data = (isset($args[1])) ? $args[1] : null;
        $header = (isset($args[2])) ? $args[2] : null;

        if (in_array($function, $options)) {
            return self::request($function, $path, $data, $header);
        } else {
            //request verb is not in the $options array
            throw new Exception($function.' is not a valid HTTP Verb');
        }
    }

    protected function request($type, $request, $data = [], $header = [])
    {
        //set up curl
        $ch = curl_init();
        
        //ser return transfer on
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //set url for request
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl.$request);

        //set type ie GET, POST
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($type));

        // Follow redirects, if any
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);

        //use headers if provided
        if (isset($header) > 0) {
            curl_setopt($ch, CURLOPT_HEADER, $header);
        }

        //use data if provided
        if (isset($data) > 0) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        // Do not check the SSL certificates
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //run request
        $response = curl_exec($ch);

        $response = json_decode($response, true);
        
        //close request
        curl_close($ch);

        //return response;
        return $response;
    }
}