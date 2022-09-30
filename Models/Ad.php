<?php
    class Ad {
        private $owner;
        private $price;
        private $squares;
        private $region;
        private $availability;

        public function __construct($owner,$price,$squares,$region,$availability) {
            $this->owner = $owner;
            $this->price = $price;
            $this->squares = $squares;
            $this->region = $region;
            $this->availability = $availability;
        }
        public function getOwner() {
            return $this->owner;
        }
        public function getPrice() {
            return $this->price;
        }
        public function getSquares() {
            return $this->squares;
        }
        public function getRegion() {
            return $this->region;
        }
        public function getAvailability() {
            return $this->availability;
        }


        public function setOwner($owner) {
            $this->owner = $owner;
        }
        public function setPrice($price) {
            $this->price = $price;
        }
        public function setSquares($squares) {
            $this->squares = $squares;
        }
        public function setRegion($region) {
            $this->region = $region;
        }
        public function setAvailability($availability) {
            $this->availability = $availability;
        }
        
}