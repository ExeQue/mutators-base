<?php

declare(strict_types=1);

namespace ExeQue\Remix\Debugging;

use ExeQue\Remix\Concerns\ResolvesStringInput;
use ExeQue\Remix\Exceptions\InvalidArgumentException;
use ExeQue\Remix\Mutate\Mutator;
use JsonSerializable;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use ReflectionClass;

/**
 * Logs a value to a PSR-3 logger.
 *
 * A default logger can be set using the `setDefaultLogger` method.
 * If no logger is provided to the constructor, the default logger will be used.
 * If no default logger is set, an exception will be thrown.
 *
 * @author Morten Harders <mmh@harders-it.dk>
 */
class Log extends Mutator
{
    use ResolvesStringInput;

    private static ?LoggerInterface $defaultLogger = null;
    private LoggerInterface $logger;
    private string $prefix;
    private string $level;
    private array $context;

    /**
     * @param  LoggerInterface|null  $logger  The logger to log to (optional). If not provided, the default logger will be used.
     * @param  string  $prefix  A prefix to prepend to the logged message (default: '').
     * @param  string  $level  The log level to use (default: LogLevel::DEBUG).
     * @param  array  $context  Additional context to pass to the logger (default: []).
     */
    public function __construct(LoggerInterface $logger = null, string $prefix = '', string $level = LogLevel::DEBUG, array $context = [])
    {
        $this->logger  = $logger ?? self::$defaultLogger ?? throw new InvalidArgumentException('No logger provided');
        $this->prefix  = $prefix;
        $this->level   = $level;
        $this->context = $context;
    }

    /**
     * @param  LoggerInterface|null  $logger  The logger to log to (optional). If not provided, the default logger will be used.
     * @param  string  $prefix  A prefix to prepend to the logged message (default: '').
     * @param  string  $level  The log level to use (default: LogLevel::DEBUG).
     * @param  array  $context  Additional context to pass to the logger (default: []).
     */
    public static function make(LoggerInterface $logger = null, string $prefix = '', string $level = LogLevel::DEBUG, array $context = []): self
    {
        return new self($logger, $prefix, $level, $context);
    }

    /**
     * Set the default logger instance to use. If no logger is provided to the constructor, this logger will be used.
     *
     * @return LoggerInterface|null The previous default logger instance (if any).
     */
    public static function setDefaultLogger(?LoggerInterface $logger): ?LoggerInterface
    {
        $previousLogger = self::$defaultLogger;

        self::$defaultLogger = $logger;

        return $previousLogger;
    }

    public function mutate(mixed $value): mixed
    {
        $this->logValue($value);

        return $value;
    }

    private function logValue(mixed $value): void
    {
        $message = $this->resolveMessage($value);

        $this->logger->log($this->level, $message, $this->context);
    }

    private function resolveMessage(mixed $value)
    {
        $message = '';

        if ($this->prefix) {
            $message .= $this->prefix . ': ';
        }

        if (is_string($value)) {
            return $message . $value;
        }

        if (is_bool($value)) {
            return $message . $value ? 'true' : 'false';
        }

        if (is_null($value)) {
            return $message . 'null';
        }

        if (is_numeric($value)) {
            return $message . $value;
        }

        if (is_array($value)) {
            return $message . json_encode($value);
        }

        if (is_object($value)) {
            $reflector = new ReflectionClass($value);

            if ($reflector->isAnonymous()) {
                $classPrefix = 'Anonymous class: ';
            } else {
                $classPrefix = get_class($value) . ': ';
            }

            if ($value instanceof JsonSerializable) {
                /** @noinspection JsonEncodingApiUsageInspection */
                return $message . $classPrefix . json_encode($value);
            }

            try {
                return $message . $this->resolveStringInput($value);
            } catch (InvalidArgumentException) {
                return $message . $classPrefix . serialize($value);
            }

        }

        return $message . gettype($value);
    }
}
