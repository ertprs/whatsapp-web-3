<?php
 namespace Silex\Tests\Provider\ValidatorServiceProviderTest\Constraint; use Symfony\Component\Validator\Constraint; class Custom extends Constraint { public $message = 'This field must be ...'; public $table; public $field; public function validatedBy() { return 'test.custom.validator'; } } 