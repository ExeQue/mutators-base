# Pipe separated serialization

## Classes

### Pipe separated joiner

This mutator does the following:
1. Converts the input to an array (if it isn't already)
2. Removes empty values
3. Converts each value to a string
4. Trims each value
5. Joins the values with a pipe separator

```php
namespace My\Application;

use ExeQue\Remix\Mutate\Array\Filter;
use ExeQue\Remix\Mutate\Array\Implode;
use ExeQue\Remix\Mutate\Array\Map;
use ExeQue\Remix\Mutate\Convert\ToArray;
use ExeQue\Remix\Mutate\Convert\ToString;
use ExeQue\Remix\Mutate\Sequence;
use ExeQue\Remix\Mutate\String\Trim;

class PipeSeparatedJoiner extends MutatorAlias
{
    use Makes; // Provides the `make()` method

    public function __construct()
    {
        parent::__construct(
            new Sequence([ // Run the mutators in sequence
                ToArray::make(), // Convert input to an array (if it isn't already)
                Filter::make(), // Remove empty values
                Map::make(Sequence::make([
                    ToString::make(), // Convert each value to a string
                    Trim::make(), // Trim each value
                ])),
                Implode::make('|'), // Join the values with a pipe separator
            ])
        );
    }
}
```

### Pipe separated exploder

This mutator does the following:
1. Explodes the input with a pipe separator
2. Trims each value
3. Removes empty values
4. Resets the keys

```php
namespace My\Application;

use ExeQue\Remix\Mutate\Array\Filter;
use ExeQue\Remix\Mutate\Array\Map;
use ExeQue\Remix\Mutate\Array\Values;
use ExeQue\Remix\Mutate\Sequence;
use ExeQue\Remix\Mutate\String\Explode;
use ExeQue\Remix\Mutate\String\Trim;

class PipeSeparatedExploder extends MutatorAlias
{
    use Makes; // Provides the `make()` method

    public function __construct()
    {
        parent::__construct(
            new Sequence([ // Run the mutators in sequence
                Explode::make('|'), // Explode the string with a pipe separator
                Map::make(Trim::make()), // Trim each value
                Filter::make(), // Remove empty values
                Values::make(), // Reset the keys
            ])
        );
    }
}
```

### Pipe separated serializer

Use the two previous mutators to create a serializer for encoding and decoding pipe-separated strings.

This can serve as a reusable serializer for any case where you need to serialize an array to a pipe-separated string and vice versa.
Can easily be extended to support other separators (e.g. comma-separated, semicolon-separated, etc. as a fallback when decoding).

```php
namespace My\Application;

use ExeQue\Remix\Mutate\MutatorInterface;

class PipeSeparatedSerializer implements SerializerInterface
{
    private MutatorInterface $encoder;
    private MutatorInterface $decoder;

    public function __construct()
    {
        $this->encoder = new PipeSeparatedJoiner();
        $this->decoder = new PipeSeparatedExploder();
    }

    public function encode(mixed $value): string
    {
        return $this->encoder->mutate($value);
    }

    public function decode(mixed $value): array
    {
        return $this->decoder->mutate($value);
    }
}
```

## Usage

```php
$serializer = new PipeSeparatedSerializer();

// Encode an array to a pipe-separated string
$encoded = $serializer->encode(['foo', 'bar', 'baz']);
var_dump($encoded); // string(11) "foo|bar|baz"

// Decode a pipe-separated string to an array
$decoded = $serializer->decode('foo|bar|baz');
var_dump($decoded); // array(3) { [0]=> string(3) "foo" [1]=> string(3) "bar" [2]=> string(3) "baz" }
```
