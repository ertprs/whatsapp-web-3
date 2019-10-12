<?php
 namespace Doctrine\DBAL\Tools\Console\Command; use Symfony\Component\Console\Input\InputOption; use Symfony\Component\Console\Command\Command; use Symfony\Component\Console\Input\InputInterface; use Symfony\Component\Console\Output\OutputInterface; use Doctrine\DBAL\Platforms\Keywords\ReservedKeywordsValidator; class ReservedWordsCommand extends Command { private $keywordListClasses = array( 'mysql' => 'Doctrine\DBAL\Platforms\Keywords\MySQLKeywords', 'mysql57' => 'Doctrine\DBAL\Platforms\Keywords\MySQL57Keywords', 'sqlserver' => 'Doctrine\DBAL\Platforms\Keywords\SQLServerKeywords', 'sqlserver2005' => 'Doctrine\DBAL\Platforms\Keywords\SQLServer2005Keywords', 'sqlserver2008' => 'Doctrine\DBAL\Platforms\Keywords\SQLServer2008Keywords', 'sqlserver2012' => 'Doctrine\DBAL\Platforms\Keywords\SQLServer2012Keywords', 'sqlite' => 'Doctrine\DBAL\Platforms\Keywords\SQLiteKeywords', 'pgsql' => 'Doctrine\DBAL\Platforms\Keywords\PostgreSQLKeywords', 'pgsql91' => 'Doctrine\DBAL\Platforms\Keywords\PostgreSQL91Keywords', 'pgsql92' => 'Doctrine\DBAL\Platforms\Keywords\PostgreSQL92Keywords', 'oracle' => 'Doctrine\DBAL\Platforms\Keywords\OracleKeywords', 'db2' => 'Doctrine\DBAL\Platforms\Keywords\DB2Keywords', 'sqlanywhere' => 'Doctrine\DBAL\Platforms\Keywords\SQLAnywhereKeywords', 'sqlanywhere11' => 'Doctrine\DBAL\Platforms\Keywords\SQLAnywhere11Keywords', 'sqlanywhere12' => 'Doctrine\DBAL\Platforms\Keywords\SQLAnywhere12Keywords', 'sqlanywhere16' => 'Doctrine\DBAL\Platforms\Keywords\SQLAnywhere16Keywords', ); public function setKeywordListClass($name, $class) { $this->keywordListClasses[$name] = $class; } protected function configure() { $this ->setName('dbal:reserved-words') ->setDescription('Checks if the current database contains identifiers that are reserved.') ->setDefinition(array( new InputOption( 'list', 'l', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Keyword-List name.' ) )) ->setHelp(<<<EOT
Checks if the current database contains tables and columns
with names that are identifiers in this dialect or in other SQL dialects.

By default SQLite, MySQL, PostgreSQL, Microsoft SQL Server, Oracle
and SQL Anywhere keywords are checked:

    <info>%command.full_name%</info>

If you want to check against specific dialects you can
pass them to the command:

    <info>%command.full_name% mysql pgsql</info>

The following keyword lists are currently shipped with Doctrine:

    * mysql
    * mysql57
    * pgsql
    * pgsql92
    * sqlite
    * oracle
    * sqlserver
    * sqlserver2005
    * sqlserver2008
    * sqlserver2012
    * sqlanywhere
    * sqlanywhere11
    * sqlanywhere12
    * sqlanywhere16
    * db2 (Not checked by default)
EOT
); } protected function execute(InputInterface $input, OutputInterface $output) { $conn = $this->getHelper('db')->getConnection(); $keywordLists = (array) $input->getOption('list'); if ( ! $keywordLists) { $keywordLists = array( 'mysql', 'mysql57', 'pgsql', 'pgsql92', 'sqlite', 'oracle', 'sqlserver', 'sqlserver2005', 'sqlserver2008', 'sqlserver2012', 'sqlanywhere', 'sqlanywhere11', 'sqlanywhere12', 'sqlanywhere16', ); } $keywords = array(); foreach ($keywordLists as $keywordList) { if (!isset($this->keywordListClasses[$keywordList])) { throw new \InvalidArgumentException( "There exists no keyword list with name '" . $keywordList . "'. ". "Known lists: " . implode(", ", array_keys($this->keywordListClasses)) ); } $class = $this->keywordListClasses[$keywordList]; $keywords[] = new $class; } $output->write('Checking keyword violations for <comment>' . implode(", ", $keywordLists) . "</comment>...", true); $schema = $conn->getSchemaManager()->createSchema(); $visitor = new ReservedKeywordsValidator($keywords); $schema->visit($visitor); $violations = $visitor->getViolations(); if (count($violations) == 0) { $output->write("No reserved keywords violations have been found!", true); } else { $output->write('There are <error>' . count($violations) . '</error> reserved keyword violations in your database schema:', true); foreach ($violations as $violation) { $output->write('  - ' . $violation, true); } return 1; } } } 