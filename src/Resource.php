<?php

namespace Apersestudio\Digitalocean {

    abstract class Resource {

        protected $endpoint = "https://api.digitalocean.com/v2/";

        // No direct instancing
        public function __construct($http) {
            $this->http = $http;
        }

    }

}