<?php

namespace Apersestudio\Digitalocean\Resources {

    use \Exception;
    use Apersestudio\Digitalocean\Resource;

    class Vpcs extends Resource {

        public function getAll(int $perpage=20, int $page=1):array {
            $params = ["perpage"=>$perpage, "page"=>$page];
            $request = $this->http->get($this->endpoint . "vpcs", $params);
            $code = $request->status();
            switch ($code) {
                // Success
                case 200: 
                    $response = $request->json();
                    $mainkey = "vpcs";
                    $response["data"] = $response[$mainkey];
                    unset($response[$mainkey]);
                    return $response;
                // Errors
                case 401: throw new Exception("Bad authentication", $code);
                case 404: throw new Exception("Request not found.", $code);
                case 429: throw new Exception("Request limit exceeded", $code);
                case 500: throw new Exception("DigitalOcean Error", $code);
                default: throw new Exception("DigitalOcean Event: ".$code, $code);
            }
        }

        public function create($params):array {
            $request = $this->http->post($this->endpoint . "vpcs", $params);
            $code = $request->status();
            switch ($code) {
                // Success
                case 201: 
                    $response = $request->json();
                    $mainkey = "vpc";
                    $response["data"] = $response[$mainkey];
                    unset($response[$mainkey]);
                    return $response;
                // Errors
                case 401: throw new Exception("Bad authentication", $code);
                case 429: throw new Exception("Request limit exceeded", $code);
                case 500: throw new Exception("DigitalOcean Error", $code);
                default: throw new Exception("DigitalOcean Event: ".$code, $code);
            }
        }

    }

}