<?php
 namespace Symfony\Component\Security\Csrf\TokenGenerator; class UriSafeTokenGenerator implements TokenGeneratorInterface { private $entropy; public function __construct($entropy = 256) { $this->entropy = $entropy; } public function generateToken() { $bytes = random_bytes($this->entropy / 8); return rtrim(strtr(base64_encode($bytes), '+/', '-_'), '='); } } 