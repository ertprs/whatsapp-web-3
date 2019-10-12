<?php
class DieHardTest extends PHPUnit_Framework_TestCase { public function testBirthday() { $num_buckets = 17; $tolerance = 0.03; $rand_min = 200000; $rand_max = 600000; $rand_step = 100000; $minT = (1.00 - $tolerance); $maxT = (1.00 + $tolerance); for ($nums_to_generate = $rand_min; $nums_to_generate < $rand_max; $nums_to_generate += $rand_step) { $buckets = array_fill(0, $num_buckets, 0); $min = (int) ceil($minT * $nums_to_generate / $num_buckets); $max = (int) floor($maxT * $nums_to_generate / $num_buckets); for ($i = 0; $i < $nums_to_generate; ++$i) { $random = random_int(0, 999); $bucket = $random % $num_buckets; $buckets[$bucket]++; } for ($i = 0; $i < $num_buckets; ++$i) { if ($buckets[$i] <= $min ) { var_dump([ 'bucket' => $i, 'value' => $buckets[$i], 'min' => $min, 'nums' => $nums_to_generate, 'reason' => 'below min' ]); } if ($buckets[$i] >= $max ) { var_dump([ 'bucket' => $i, 'value' => $buckets[$i], 'maax' => $max, 'nums' => $nums_to_generate, 'reason' => 'above max' ]); } $this->assertTrue($buckets[$i] < $max && $buckets[$i] > $min); } } } }