<?php

namespace Apersestudio\DigitalOcean\Resources {

    use \Exception;
    use Apersestudio\DigitalOcean\Resource;

    class Databases extends Resource {

        public function createCluster(array $params):array {
            $request = $this->http->post($this->endpoint."databases", $params);
            $code = $request->status();
            switch ($code) {
                // Success
                case 201:
                    
                    // Format the cluster data
                    $response = $request->json();
                    $mainkey = "database";
                    $response["data"] = $response[$mainkey];
                    unset($response[$mainkey]);

                    // This code will lock the execution of this function until the cluster is online
                    $finished = false;
                    do {
                        $clusterInfo = $this->getClusterByUUID($response["data"]["id"]);
                        // Just sleep if the status is not online
                        $finished = ($clusterInfo["data"]["status"] == "online");
                        if (!$finished) { sleep(20); }
                    } while (!$finished);
                    
                    return $response;
                // Errors
                case 401: throw new Exception("Bad authentication", $code);
                case 404: throw new Exception("Request not found.", $code);
                case 429: throw new Exception("Request limit exceeded", $code);
                case 500: throw new Exception("DigitalOcean Error", $code);
                default: throw new Exception("DigitalOcean Event: ".$code, $code);
            }
        }

        public function getClusterByUUID(string $clusterUUID) {
            $request = $this->http->get($this->endpoint . "databases/" . $clusterUUID);
            $code = $request->status();
            switch ($code) {
                // Success
                case 200:
                    $response = $request->json();
                    $mainkey = "database";
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

        public function getClusterCertificateByUUID(string $clusterUUID) {
            $request = $this->http->get($this->endpoint . "databases/" . $clusterUUID . "/ca");
            $code = $request->status();
            switch ($code) {
                // Success
                case 200:
                    $response = $request->json();
                    $response["data"] = $response["ca"]["certificate"];
                    unset($response["ca"]["certificate"]);
                    return $response;
                // Errors
                case 401: throw new Exception("Bad authentication", $code);
                case 404: throw new Exception("Request not found.", $code);
                case 429: throw new Exception("Request limit exceeded", $code);
                case 500: throw new Exception("DigitalOcean Error", $code);
                default: throw new Exception("DigitalOcean Event: ".$code, $code);
            }
        }

        public function createDatabaseUser(string $clusterUUID, string $username):array {
            $request = $this->http->post($this->endpoint . "databases/" . $clusterUUID . "/users", ["name"=>$username]);
            $code = $request->status();
            switch ($code) {
                case 201:
                    $response = $request->json();
                    $mainkey = "user";
                    $response["data"] = $response[$mainkey];
                    unset($response[$mainkey]);
                    return $response;
                case 401: throw new Exception("Bad authentication", $code);
                case 404: throw new Exception("Request not found.", $code);
                case 429: throw new Exception("Request limit exceeded", $code);
                case 500: throw new Exception("DigitalOcean Error", $code);
                default: throw new Exception("DigitalOcean Event: ".$code, $code);
            }
        }

        public function getDatabaseUser(string $clusterUUID, string $username):array {
            $request = $this->http->get($this->endpoint . "databases/" . $clusterUUID . "/users/" . $username);
            $code = $request->status();
            switch ($code) {
                case 200:
                    $response = $request->json();
                    $mainkey = "user";
                    $response["data"] = $response[$mainkey];
                    unset($response[$mainkey]);
                    return $response;
                case 401: throw new Exception("Bad authentication", $code);
                case 404: throw new Exception("Request not found.", $code);
                case 429: throw new Exception("Request limit exceeded", $code);
                case 500: throw new Exception("DigitalOcean Error", $code);
                default: throw new Exception("DigitalOcean Event: ".$code, $code);
            }
        }

        public function getDatabase(string $clusterUUID, string $database):array {
            $request = $this->http->get($this->endpoint . "databases/" . $clusterUUID . "/dbs/" . $database);
            $code = $request->status();
            switch ($code) {
                case 200:
                    $response = $request->json();
                    $mainkey = "db";
                    $response["data"] = $response[$mainkey];
                    unset($response[$mainkey]);
                    return $response;
                case 401: throw new Exception("Bad authentication", $code);
                case 404: throw new Exception("Request not found.", $code);
                case 429: throw new Exception("Request limit exceeded", $code);
                case 500: throw new Exception("DigitalOcean Error", $code);
                default: throw new Exception("DigitalOcean Event: ".$code, $code);
            }
        }

        public function createDatabase(string $clusterUUID, string $database):array {
            $request = $this->http->post($this->endpoint . "databases/" . $clusterUUID . "/dbs", ["name"=>$database]);
            $code = $request->status();
            switch ($code) {
                case 201:
                    $response = $request->json();
                    $mainkey = "db";
                    $response["data"] = $response[$mainkey];
                    unset($response[$mainkey]);
                    return $response;
                case 401: throw new Exception("Bad authentication", $code);
                case 404: throw new Exception("Request not found.", $code);
                case 429: throw new Exception("Request limit exceeded", $code);
                case 500: throw new Exception("DigitalOcean Error", $code);
                default: throw new Exception("DigitalOcean Event: ".$code, $code);
            }
        }

        public function options() {
            $request = $this->http->get($this->endpoint . "databases/options");
            $code = $request->status();
            switch ($code) {
                case 200:
                    $response = $request->json();
                    $mainkey = "options";
                    $response["data"] = $response[$mainkey];
                    unset($response[$mainkey]);
                    return $response;
                case 401: throw new Exception("Bad authentication", $code);
                case 404: throw new Exception("Request not found.", $code);
                case 429: throw new Exception("Request limit exceeded", $code);
                case 500: throw new Exception("DigitalOcean Error", $code);
                default: throw new Exception("DigitalOcean Event: ".$code, $code);
            }
        }

    }

}