<?php

declare(strict_types=1);

namespace ExeQue\Remix\Mutate\String;

use ExeQue\Remix\Assert;
use ExeQue\Remix\Exceptions\MissingTagException;

/**
 * Replaces tags `{{ tag }}` in a string with values from a map.
 *
 * Available options:
 * - `forceLowerCaseKeys` (bool): Force all keys to be lower case. Defaults to `false`.
 * - `throwWhenMissing` (bool): Throw an exception when a tag is missing. Defaults to `false`.
 * - `removeOnMissing` (mixed): Remove the tag when it is missing. Defaults to `false`.
 *
 * Example:
 * ```php
 * $tags = [
 *    'name' => 'General Kenobi',
 * ];
 *
 * Tags::make($tags)->mutate('Hello there, {{ name }}!'); // 'Hello there, General Kenobi!'
 * ```
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Tags extends StringMutator
{
    private array $tags;

    private bool $throwWhenMissing;

    private bool $forceLowerCaseKeys;

    private string $pattern = '/{{\s*([^{}]+[\S])\s*}}/';
    private mixed $removeOnMissing;

    public function __construct(array $tags, array $options = [])
    {
        Assert::isMap($tags, 'Tags must be a map');
        Assert::allScalar($tags, 'Tags must be scalar values. Got: %s');

        $this->tags = $tags;

        $this->setOptions($options);

        if ($this->forceLowerCaseKeys) {
            $this->tags = array_change_key_case($this->tags);
        }
    }

    public static function make(array $tags, array $options = []): self
    {
        return new self($tags, $options);
    }

    protected function mutateString(string $value): string
    {
        $callback = function ($matches) {
            $key = $this->forceLowerCaseKeys ? mb_strtolower($matches[1]) : $matches[1];

            $exists = array_key_exists($key, $this->tags);

            if (! $exists && $this->throwWhenMissing) {
                $message = "Missing tag: '{$key}'";

                $similar = $this->resolveSimilarTag($key);
                if ($similar !== null) {
                    $message .= ". Did you mean: '{$similar}'?";
                }

                throw new MissingTagException($message);
            }

            if ($exists) {
                $replacement = $this->tags[$key];
            } elseif ($this->removeOnMissing) {
                $replacement = '';
            } else {
                $replacement = $matches[0];
            }

            return $replacement;
        };

        return preg_replace_callback($this->pattern, $callback, $value);
    }

    private function resolveSimilarTag(mixed $key): string|null
    {
        $tags = $this->tags;

        $keys = array_keys($tags);

        $similarities = array_combine(
            $keys,
            array_map(
                static fn (string $tagKey) => similar_text($tagKey, $key),
                $keys
            )
        );

        $similarities = array_filter($similarities, static fn (int $similarity) => $similarity > 0);

        arsort($similarities, SORT_NUMERIC);

        return array_key_first($similarities);
    }

    private function setOptions(array $options): void
    {
        if (array_key_exists('forceLowerCaseKeys', $options)) {
            Assert::boolean($options['forceLowerCaseKeys'], 'Option forceLowerCaseKeys must be a boolean');
        }
        if (array_key_exists('throwWhenMissing', $options)) {
            Assert::boolean($options['throwWhenMissing'], 'Option throwWhenMissing must be a boolean');
        }
        if (array_key_exists('removeOnMissing', $options)) {
            Assert::boolean($options['removeOnMissing'], 'Option removeOnMissing must be a boolean');
        }

        $this->forceLowerCaseKeys = $options['forceLowerCaseKeys'] ?? false;
        $this->throwWhenMissing   = $options['throwWhenMissing'] ?? false;
        $this->removeOnMissing    = $options['removeOnMissing'] ?? false;
    }
}
