<?php

namespace Kanvai\Digitalocean\Abstracts {

    use JsonSerializable;
    use Kanvai\Digitalocean\Interfaces\ArrayableInterface;

    abstract class ClusterData implements JsonSerializable, ArrayableInterface {

        protected string $id;
        protected string $name;
        protected string $engine;
        protected string $version;
        protected int $num_nodes;
        protected string $size;
        protected string $region;
        protected string $private_network_uuid;
        protected array $tags;

        public function getID():string { return $this->id; }
        public function setID(string $id):void { $this->id = $id; }
        public function getName():string { return $this->name; }
        public function setName(string $name):void { $this->name = $name; }
        public function getEngine():string { return $this->engine; }
        public function setEngine(string $engine):void { $this->engine = $engine; }
        public function getVersion():string { return $this->version; }
        public function setVersion(string $version):void { $this->version = $version; }
        public function getNumNodes():int { return $this->num_nodes; }
        public function setNumNodes(int $num_nodes):void { $this->num_nodes = $num_nodes; }
        public function getSize():string { return $this->size; }
        public function setSize(string $size):void { $this->size = $size; }
        public function getRegion():string { return $this->region; }
        public function setRegion(string $region):void { $this->region = $region; }
        public function getPrivateNetworkUUID():string { return $this->private_network_uuid; }
        public function setPrivateNetworkUUID(string $private_network_uuid):void { $this->private_network_uuid = $private_network_uuid; }
        public function getTags():array { return $this->tags; }
        public function setTags(array $tags):void { $this->tags = $tags; }

        public function jsonSerialize(): array {
            return [
                "id" => $this->id,
                "name" => $this->name,
                "engine" => $this->engine,
                "version" => $this->version,
                "num_nodes" => $this->num_nodes,
                "size" => $this->size,
                "region" => $this->region,
                "private_network_uuid" => $this->private_network_uuid,
                "tags" => $this->tags
            ];
        }

        public function toArray():array {
            return $this->jsonSerialize();
        }

    }

}