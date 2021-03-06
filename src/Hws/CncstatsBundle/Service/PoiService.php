<?php

namespace Hws\CncstatsBundle\Service;

class PoiService {
    private $levels = array(
        12	=> 1,
        13	=> 3,
        14	=> 6,
        15	=> 10,
        16	=> 15,
        17	=> 25,
        18	=> 40,
        19	=> 65,
        20	=> 100,
        21	=> 150,
        22	=> 250,
        23	=> 400,
        24	=> 650,
        25	=> 1000,
        26	=> 1500,
        27	=> 2500,
        28	=> 4000,
        29	=> 6500,
        30	=> 10000,
        31	=> 15000,
        32	=> 25000,
        33	=> 40000,
        34	=> 65000,
        35	=> 100000,
        36	=> 150000,
        37	=> 250000,
        38	=> 400000,
        39	=> 650000,
        40	=> 1000000,
        41	=> 1500000,
        42	=> 2500000,
        43	=> 4000000,
        44	=> 6500000,
        45	=> 10000000
    );

    public function getPoints($level) {
        if (isset($this->levels[$level])) {
            return $this->levels[$level];
        } else {
            return 0;
        }
    }
}
