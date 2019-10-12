<?php
 namespace Symfony\Component\Security\Core\Authorization; use Symfony\Component\Security\Core\Authentication\Token\TokenInterface; use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface; class TraceableAccessDecisionManager implements AccessDecisionManagerInterface { private $manager; private $strategy; private $voters = array(); private $decisionLog = array(); public function __construct(AccessDecisionManagerInterface $manager) { $this->manager = $manager; if ($this->manager instanceof AccessDecisionManager) { $reflection = new \ReflectionProperty(AccessDecisionManager::class, 'strategy'); $reflection->setAccessible(true); $this->strategy = $reflection->getValue($manager); $reflection = new \ReflectionProperty(AccessDecisionManager::class, 'voters'); $reflection->setAccessible(true); $this->voters = $reflection->getValue($manager); } } public function decide(TokenInterface $token, array $attributes, $object = null) { $result = $this->manager->decide($token, $attributes, $object); $this->decisionLog[] = array( 'attributes' => $attributes, 'object' => $object, 'result' => $result, ); return $result; } public function setVoters(array $voters) { @trigger_error(sprintf('The %s() method is deprecated since version 3.3 and will be removed in 4.0. Pass voters to the decorated AccessDecisionManager instead.', __METHOD__), E_USER_DEPRECATED); if (!method_exists($this->manager, 'setVoters')) { return; } $this->voters = $voters; $this->manager->setVoters($voters); } public function getStrategy() { return null === $this->strategy ? '-' : strtolower(substr($this->strategy, 6)); } public function getVoters() { return $this->voters; } public function getDecisionLog() { return $this->decisionLog; } } class_alias(TraceableAccessDecisionManager::class, DebugAccessDecisionManager::class); 