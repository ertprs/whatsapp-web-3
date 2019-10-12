<?php
 namespace Symfony\Component\Security\Core\Tests\Authorization; use PHPUnit\Framework\TestCase; use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage; use Symfony\Component\Security\Core\Authorization\AuthorizationChecker; class AuthorizationCheckerTest extends TestCase { private $authenticationManager; private $accessDecisionManager; private $authorizationChecker; private $tokenStorage; protected function setUp() { $this->authenticationManager = $this->getMockBuilder('Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface')->getMock(); $this->accessDecisionManager = $this->getMockBuilder('Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface')->getMock(); $this->tokenStorage = new TokenStorage(); $this->authorizationChecker = new AuthorizationChecker( $this->tokenStorage, $this->authenticationManager, $this->accessDecisionManager ); } public function testVoteAuthenticatesTokenIfNecessary() { $token = $this->getMockBuilder('Symfony\Component\Security\Core\Authentication\Token\TokenInterface')->getMock(); $this->tokenStorage->setToken($token); $newToken = $this->getMockBuilder('Symfony\Component\Security\Core\Authentication\Token\TokenInterface')->getMock(); $this->authenticationManager ->expects($this->once()) ->method('authenticate') ->with($this->equalTo($token)) ->will($this->returnValue($newToken)); $tokenComparison = function ($value) use ($newToken) { return $value === $newToken; }; $this->accessDecisionManager ->expects($this->once()) ->method('decide') ->with($this->callback($tokenComparison)) ->will($this->returnValue(true)); $this->assertFalse($newToken === $this->tokenStorage->getToken()); $this->assertTrue($this->authorizationChecker->isGranted('foo')); $this->assertTrue($newToken === $this->tokenStorage->getToken()); } public function testVoteWithoutAuthenticationToken() { $this->authorizationChecker->isGranted('ROLE_FOO'); } public function testIsGranted($decide) { $token = $this->getMockBuilder('Symfony\Component\Security\Core\Authentication\Token\TokenInterface')->getMock(); $token ->expects($this->once()) ->method('isAuthenticated') ->will($this->returnValue(true)); $this->accessDecisionManager ->expects($this->once()) ->method('decide') ->will($this->returnValue($decide)); $this->tokenStorage->setToken($token); $this->assertTrue($decide === $this->authorizationChecker->isGranted('ROLE_FOO')); } public function isGrantedProvider() { return array(array(true), array(false)); } } 