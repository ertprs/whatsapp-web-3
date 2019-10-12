<?php
 namespace Doctrine\Tests\DBAL\Mocks; use Doctrine\DBAL\DBALException; use Doctrine\DBAL\Platforms\AbstractPlatform; class MockPlatform extends AbstractPlatform { public function getBlobTypeDeclarationSQL(array $field) { throw DBALException::notSupported(__METHOD__); } public function getBooleanTypeDeclarationSQL(array $columnDef) {} public function getIntegerTypeDeclarationSQL(array $columnDef) {} public function getBigIntTypeDeclarationSQL(array $columnDef) {} public function getSmallIntTypeDeclarationSQL(array $columnDef) {} public function _getCommonIntegerTypeDeclarationSQL(array $columnDef) {} public function getVarcharTypeDeclarationSQL(array $field) { return "DUMMYVARCHAR()"; } public function getClobTypeDeclarationSQL(array $field) { return 'DUMMYCLOB'; } public function getJsonTypeDeclarationSQL(array $field) { return 'DUMMYJSON'; } public function getBinaryTypeDeclarationSQL(array $field) { return 'DUMMYBINARY'; } public function getVarcharDefaultLength() { return 255; } public function getName() { return 'mock'; } protected function initializeDoctrineTypeMappings() { } protected function getVarcharTypeDeclarationSQLSnippet($length, $fixed) { } } 