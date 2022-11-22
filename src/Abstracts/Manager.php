<?php

namespace Kanvai\Digitalocean\Abstracts {

    use Illuminate\Support\Facades\Config;
    use Illuminate\Support\Facades\Http;

    abstract class Manager {

        protected $endpoint = "https://api.digitalocean.com/v2/";

        // No direct instancing
        public function __construct($http) {
            $this->token = Config::get("digitalocean.connections.main.token");
            $this->http = Http::withToken($this->token);
        }

    }

}