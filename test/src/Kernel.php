<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getCacheDir(): string
    {
        return $this->getProjectDir() . '/var/cache/' . $this->environment;
    }

    public function getLogDir(): string
    {
        return $this->getProjectDir() . '/var/log';
    }

    public function getProjectDir(): string
    {
        return dirname(__DIR__);
    }

    /**
     * @return BundleInterface[]
     */
    public function registerBundles(): iterable
    {
        $contents = $this->getGlobalBundles();

        foreach ($contents as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                // @phpstan-ignore-next-line
                yield new $class();
            }
        }
    }

    /**
     * @return array<string, array<string, bool>>
     */
    private function getGlobalBundles(): array
    {
        return include $this->getProjectDir() . '/config/bundles.php';
    }
}
