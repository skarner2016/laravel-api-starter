<?php

namespace App\Console\Commands\Stubs;

use Illuminate\Console\GeneratorCommand;

class MakeRepositoryCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * The stub type
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * @desc    获取模板
     * @return string
     * @author  skarner <2022-03-24 19:15>
     */
    protected function getStub(): string
    {
        return $this->laravel->basePath('/stubs/repository.stub');
    }

    /**
     * @desc    获取命名空间
     * @param $rootNamespace
     * @return string
     * @author  skarner <2022-03-24 19:16>
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Repository';
    }
}
