<?php
/**
 * console.php
 *
 * @license        More in license.md
 * @copyright      https://fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:NodeBootstrap!
 * @subpackage     bin
 * @since          0.1.0
 *
 * @date           08.03.20
 */

declare(strict_types = 1);

use Symfony\Component\Console;

use FastyBird\NodeBootstrap\Boot;

$autoload = null;

$autoloadFiles = [
	__DIR__ . '/../vendor/autoload.php',
	__DIR__ . '/../../../autoload.php',
];

foreach ($autoloadFiles as $autoloadFile) {
	if (file_exists($autoloadFile)) {
		$autoload = $autoloadFile;
		break;
	}
}

if (!$autoload) {
	echo "Autoload file not found; try 'composer dump-autoload' first." . PHP_EOL;

	exit(1);
}

require $autoload;

$container = Boot\Bootstrap::boot()->createContainer();

/** @var Console\Application $console */
$console = $container->getByType(Console\Application::class);

exit($console->run());