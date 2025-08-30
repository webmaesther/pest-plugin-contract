<?php

declare(strict_types=1);

namespace Webmaesther\Pest\Contracts;

use Pest\Contracts\Plugins\Bootable;
use Pest\TestSuite;
use SebastianBergmann\FileIterator\Facade as PhpUnitFileIterator;

use function Pest\testDirectory;

/**
 * @internal
 */
final class Plugin implements Bootable
{
    public function boot(): void
    {
        $testsPath = TestSuite::getInstance()->rootPath.DIRECTORY_SEPARATOR.testDirectory();

        foreach ($this->getContractFiles($testsPath) as $file) {
            include_once $file;
        }
    }

    /**
     * @param  non-empty-string  $testsPath
     * @return list<non-empty-string>
     */
    public function getContractFiles(string $testsPath): array
    {
        return (new PhpUnitFileIterator)->getFilesAsArray($testsPath, 'Contract.php');
    }
}
