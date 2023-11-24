<?php

namespace App\Console\Commands;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;

class MakeMCRRCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:all {name} {--m_c : Create a new controller for the model}
    {--m_r : Create a new repository for the model}
    {--m_R : Create new form request classes and use them in the resource controller}
    {--views : Create todas las vistas para el modelo }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an Model, Controller, Repositorio Class';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();
        $create_all = true;

        if ($this->option('m_c')) {
            $create_all = false;
            $this->createController();
        }

        if ($this->option('m_r')) {
            $create_all = false;
            $this->createRepository();
        }

        if ($this->option('m_R')) {
            $create_all = false;
            $this->createRequest();
        }

        if ($this->option('views')) {
            $create_all = false;
            $this->createViews();
        }

        if($create_all){
            $this->createController();
            $this->createRepository();
            $this->createRequest();
            $this->createViews();
        }

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created successfully");
        } else {
            $this->info("File : {$path} already exits");
        }

    }
    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {

        $this->call('make:my_controller', [
            'name' => "{$this->argument('name')}",
        ]);
    }

    /**
     * Create a Repository for the model.
     *
     * @return void
     */
    protected function createRepository()
    {

        $this->call('make:my_repo', [
            'name' => "{$this->argument('name')}",
        ]);
    }

     /**
     * Create a Repository for the model.
     *
     * @return void
     */
    protected function createRequest()
    {

        $this->call('make:my_request', [
            'name' => "{$this->argument('name')}",
        ]);
    }

    /**
     * Create a Repository for the model.
     *
     * @return void
     */
    protected function createViews()
    {

        $this->call('make:index.blade', [
            'name' => "{$this->argument('name')}",
        ]);

        $this->call('make:create.blade', [
            'name' => "{$this->argument('name')}",
        ]);

        $this->call('make:edit.blade', [
            'name' => "{$this->argument('name')}",
        ]);
    }

    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getStubPath()
    {
        return __DIR__ . '/../../../stubs/model.stub';
    }

    /**
    **
    * Map the stub variables present in stub to its value
    *
    * @return array
    *
    */
    public function getStubVariables()
    {
        return [
            'namespace'  => 'App\\Models',
            'class'      => $this->getSingularClassName($this->argument('name'))
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }


    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub , $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('{{ '.$search.' }}' , $replace, $contents);
        }

        return $contents;

    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFilePath()
    {
        return base_path('App\\Models') .'\\' .$this->getSingularClassName($this->argument('name')) . '.php';
    }

    /**
     * Return the Singular Capitalize Name
     * @param $name
     * @return string
     */
    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

    /**
     * Return the Singular Lowercase Name
     * @param $name
     * @return string
     */
    public function getSingularLowercaseClassName($name)
    {
        return strtolower(Pluralizer::plural($name));
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

}