<?php

namespace App\Twig;

use App\Service\MarkdownHelper;
use function GuzzleHttp\Psr7\parse_header;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;


class AppExtension extends AbstractExtension
{
    /**
     * @var MarkdownHelper
     */
    private $helper;

    public function __construct(MarkdownHelper $helper)
    {
        $this->helper = $helper;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('cached_markdown', [$this, 'processMarkdown'], ['is_safe' => ['html']]),
        ];
    }

    public function processMarkdown($value)
    {
        return $this->helper->parse($value);
    }
}
