<?php

$fileContent = '<?php

namespace Migrations;

use Framework\Migrations\Migrations;
use Framework\Migrations\MigrationInterface;

class ' . $className . ' extends Migrations implements MigrationInterface
{
    public function up(): void
    {
        $this->addSql("Your sql script here");
    }

    public function down(): void
    {
        $this->addSql("Drop sql script here");
    }
}
';