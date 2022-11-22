<?php

namespace Kanvai\DigitalOcean\Interfaces {

    use \Exception;

    interface DatabasesManagerInterface {

        public function createCluster(ClusterData $clusterData):array;

        public function getClusterByUUID(string $clusterUUID);

        public function getClusterCertificateByUUID(string $clusterUUID);

        public function createDatabaseUser(string $clusterUUID, string $username):array;

        public function getDatabaseUser(string $clusterUUID, string $username):array;

        public function getDatabase(string $clusterUUID, string $database):array;

        public function createDatabase(string $clusterUUID, string $database):array;

    }

}