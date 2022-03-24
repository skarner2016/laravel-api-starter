<?php

namespace App\Console\Commands\Stubs;

use Illuminate\Console\GeneratorCommand;

class MakeServiceCommand extends GeneratorCommand
{
    /**
     * 命令信号
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * 命令描述
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * 模板类型
     * @var string
     */
    protected $type = 'Service';

    /**
     * @desc    获取模板
     * @return string
     * @author  skarner <2022-03-24 19:15>
     */
    protected function getStub(): string
    {
        return $this->laravel->basePath('/stubs/service.stub');
    }

    /**
     * @desc    获取命名空间
     * @param $rootNamespace
     * @return string
     * @author  skarner <2022-03-24 19:16>
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }
}
