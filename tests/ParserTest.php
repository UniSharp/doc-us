<?php

namespace Tests;

use UniSharp\DocUs\Parser;
use Illuminate\Support\Facades\DB;

class ParserTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        DB::statement('DROP TABLE IF EXISTS `tests`');
    }

    public function testTableName()
    {
        DB::statement(
            'CREATE TABLE `tests` (
               `test` VARCHAR(1)
            )'
        );

        $schema = Parser::getSchema();

        $this->assertEquals('tests', $schema[0]['name']);

        DB::statement('DROP TABLE `tests`');
    }

    public function testColumn()
    {
        DB::statement(
            "CREATE TABLE `tests` (
               `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'comment',
               PRIMARY KEY (`id`)
            )"
        );

        $schema = Parser::getSchema();
        $column = $schema[0]['columns'][0];

        $this->assertEquals('id', $column->name);
        $this->assertEquals('INT(10) UNSIGNED', $column->type);
        $this->assertEquals('', $column->default);
        $this->assertEquals('comment', $column->description);

        $this->assertContains('Primary', $column->attributes);
        $this->assertContains('Auto increment', $column->attributes);
        $this->assertContains('Not null', $column->attributes);

        DB::statement('DROP TABLE `tests`');
    }

    public function testNull()
    {
        DB::statement(
            'CREATE TABLE `tests` (
               `test` VARCHAR(1) NULL
            )'
        );

        $schema = Parser::getSchema();
        $column = $schema[0]['columns'][0];

        $this->assertEquals('NULL', $column->default);

        DB::statement('DROP TABLE `tests`');
    }

    public function testDefault()
    {
        DB::statement(
            "CREATE TABLE `tests` (
               `test` VARCHAR(10) NULL DEFAULT 'default'
            )"
        );

        $schema = Parser::getSchema();
        $column = $schema[0]['columns'][0];

        $this->assertEquals('default', $column->default);

        DB::statement('DROP TABLE `tests`');
    }

    public function testPrimaryKey()
    {
        DB::statement(
            "CREATE TABLE `tests` (
               `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
               PRIMARY KEY (`id`)
            )"
        );

        $schema = Parser::getSchema();
        $indices = $schema[0]['indices'][0];

        $this->assertEquals('PRIMARY', $indices->name);
        $this->assertEquals('PRIMARY', $indices->type);

        $this->assertContains('id', $indices->columns);

        DB::statement('DROP TABLE `tests`');
    }

    public function testUniqueKey()
    {
        DB::statement(
            "CREATE TABLE `tests` (
               `service` VARCHAR(255) NOT NULL,
               `uid` VARCHAR(255) NOT NULL,
               UNIQUE KEY `service_uid_unique` (`service`,`uid`)
            )"
        );

        $schema = Parser::getSchema();
        $indices = $schema[0]['indices'][0];

        $this->assertEquals('service_uid_unique', $indices->name);
        $this->assertEquals('UNIQUE', $indices->type);

        $this->assertContains('service', $indices->columns);
        $this->assertContains('uid', $indices->columns);

        DB::statement('DROP TABLE `tests`');
    }

    public function testIndexKey()
    {
        DB::statement(
            "CREATE TABLE `tests` (
               `user_id` INT(10) UNSIGNED NOT NULL,
               KEY `user_id_index` (`user_id`)
            )"
        );

        $schema = Parser::getSchema();
        $indices = $schema[0]['indices'][0];

        $this->assertEquals('user_id_index', $indices->name);
        $this->assertEquals('INDEX', $indices->type);

        $this->assertContains('user_id', $indices->columns);

        DB::statement('DROP TABLE `tests`');
    }

    public function testExcludeTable()
    {
        DB::statement(
            "CREATE TABLE `tests` (
                `tests` VARCHAR(1)
            )"
        );

        $exclude = ['tests'];

        $schema = Parser::getSchema($exclude);
        $tables = $schema->map(function ($table) {
            return $table['name'];
        });

        $excludeTablesOnResult = $tables->filter(function ($table) use ($exclude) {
            return in_array($table, $exclude);
        });

        $this->assertEquals(0, count($excludeTablesOnResult));

        DB::statement('DROP TABLE `tests`');
    }
}
