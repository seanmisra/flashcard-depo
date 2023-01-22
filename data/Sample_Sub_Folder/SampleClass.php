<?php 

namespace samplePackage;
class SampleClass {
    # this only works because the access modifiers are private, the variables are then implied 
    public function __construct() {}

    public function sampleFunction($val) {
        echo "Hello " . $val;
    }
}