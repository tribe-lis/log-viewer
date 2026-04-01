<?php

declare(strict_types=1);

namespace App\Logs;

use JsonException;
use Opcodes\LogViewer\Logs\Log;

class SymfonyLog extends Log
{
    public static string $name = 'Symfony';

    public static string $regex = '/^{"message":"(?<message>.*?)","context":(?<context>.*?),"level":(?<level>\d{3}),"level_name":"(?<level_name>.*?)","channel":"(?<channel>.*?)","extra":(?<extra>.*?),"@timestamp":"(?<datetime>.*?)","id":"(?<id>.*?)","app":"(?<app>.*?)"}$/';

    public static string $regexLevelKey = 'level_name';

    public static array $columns = [
        ['label' => 'Severity', 'data_path' => 'level'],
        ['label' => 'Datetime', 'data_path' => 'datetime'],
        ['label' => 'Channel', 'data_path' => 'extra.channel'],
        ['label' => 'App', 'data_path' => 'extra.app'],
        ['label' => 'Message', 'data_path' => 'message'],
    ];

    /**
     * @throws JsonException
     */
    public function fillMatches(array $matches = []): void
    {
        parent::fillMatches($matches);

        $context = json_decode($matches['context'], true, flags: JSON_THROW_ON_ERROR);
        foreach ($context as $contextKey => $values) {
            foreach ($values as $key => $value) {
                if (is_string($value) && json_validate($value)) {
                    $context[$contextKey][$key] = json_decode($value, true, flags: JSON_THROW_ON_ERROR);
                }
            }
        }

        $this->context = $context;
        $this->text = preg_replace('/("context":)(.*?)(,"level")/', '$1"..."$3', $this->text);
        $this->extra['channel'] = $matches['channel'];
        $this->extra['app'] = str_replace('-', '‑', $matches['app']);
    }
}
