<?php

namespace Elimuswift\DbExporter\Commands;

use Elimuswift\DbExporter\DbExportHandler;

class MigrationsGeneratorCommand extends GeneratorCommand
{
    protected $name = 'db-exporter:migrations';

    protected $description = 'Export your database to migrations.';
    /**
     * @var \Elimuswift\DbExporter\DbExportHandler
     */
    protected $handler;

    public function __construct(DbExportHandler $handler)
    {
        parent::__construct();

        $this->handler = $handler;
    }

    //end __construct()

    public function handle()
    {
        $database = $this->argument('database');

        // Display some helpfull info
        if (empty($database)) {
            $this->comment("Preparing the migrations for database: {$this->getDatabaseName()}");
            $database = $this->getDatabaseName();
        } else {
            $this->comment("Preparing the migrations for database {$database}");
        }

        $this->fireAction('migrate', $database);

        // Symfony style block messages
        $this->blockMessage('Success!', 'Database migrations generated in: '.$this->handler->getMigrationsFilePath());
    }

    //end fire()
}//end class
