<?php

namespace App\Twig;

use App\Service\MarkdownHelper;
use function GuzzleHttp\Psr7\parse_header;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;


class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{
    /**
     * @var MarkdownHelper
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('cached_markdown', [$this, 'processMarkdown'], ['is_safe' => ['html']]),
        ];
    }

    public function processMarkdown($value)
    {
        return $this->container
            ->get('foo')
            ->parse($value);
    }

    public static function getSubscribedServices()
    {
        return [
            'foo' => MarkdownHelper::class
        ];
    }

}
