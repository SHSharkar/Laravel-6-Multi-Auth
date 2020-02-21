<?php

namespace SHSharkar\Laravel6MultiAuth\Commands;

use Symfony\Component\Console\Input\InputOption;
use SHSharkar\Laravel6MultiAuth\Commands\InstallAndReplaceCommand;
use SHSharkar\Laravel6MultiAuth\Commands\Traits\OverridesCanReplaceKeywords;
use SHSharkar\Laravel6MultiAuth\Commands\Traits\OverridesGetArguments;
use SHSharkar\Laravel6MultiAuth\Commands\Traits\ParsesServiceInput;
// use SplFileInfo;

class AuthViewsInstallCommand extends InstallAndReplaceCommand
{
    use OverridesCanReplaceKeywords, OverridesGetArguments, ParsesServiceInput;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'l6ma:views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install multi-auth views';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $this->installViews();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    public function getOptions()
    {
        $parentOptions = parent::getOptions();
        return array_merge($parentOptions, [
            ['lucid', false, InputOption::VALUE_NONE, 'Lucid architecture'],
            ['domain', false, InputOption::VALUE_NONE, 'Install in a subdomain'],
        ]);
    }

    /**
     * Install Web Routes.
     *
     * @return bool
     */
    public function installViews()
    {
        $name = $this->getParsedNameInput();

        $path = '/resources/views/' . $name . '/';
        $views = __DIR__ . '/../stubs/views/';

        if ($this->option('lucid')) {
            $service = $this->getParsedServiceInput();

            $path = '/src/Services/' . studly_case($service) . '/resources/views/' . $name . '/';
            $views = !$this->option('domain')
                ? __DIR__ . '/../stubs/Lucid/views/'
                : __DIR__ . '/../stubs/Lucid/domain-views/';
        }

        if ($this->installFiles($path, $this->files->allFiles($views))) {
            $this->info('Copied: ' . $path);
        }
    }

    /**
     * Get file extension.
     *
     * @param $file
     * @return bool
     */
    protected function getExtension($file)
    {
        return 'php';
    }
}