<?php

namespace Apersestudio\Digitalocean {

    use \Exception;
    use \Illuminate\Support\Facades\Http;
    use \Config;

    class APIV2 {

        private $resources = [];

        private $token;
        private $http;

        /**
         * /////////////////////////////////////////////////////////////////////////
         * Singleton Model consumes less resources when executing
         * /////////////////////////////////////////////////////////////////////////
         */
        private static APIV2 $instance;
        private function __clone() {} // No cloning
        public static function getInstance():static { // The only way for instancing
            if (!isset(self::$instance)) { self::$instance = new static(); }
            return self::$instance;
        }

        // No direct instancing
        private function __construct() {
            $this->token = Config::get("digitalocean.connections.main.token");
            $this->http = Http::withToken($this->token);
        }

        public function getResource(string $resource) {
            if (!isset($this->resources[$resource])) {
                $resourceClass = "\\Apersestudio\\DigitalOcean\\Resources\\".$resource;
                $this->resources[$resource] = new $resourceClass($this->http);
            }
            return $this->resources[$resource];
        }
        
    }

}