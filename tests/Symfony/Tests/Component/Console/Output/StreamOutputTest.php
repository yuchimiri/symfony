<?php

/*
 * This file is part of the Symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Tests\Component\Console\Output;

use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\StreamOutput;

class StreamOutputTest extends \PHPUnit_Framework_TestCase
{
    protected $stream;

    public function setUp()
    {
        $this->stream = fopen('php://memory', 'a', false);
    }

    public function testConstructor()
    {
        try {
            $output = new StreamOutput('foo');
            $this->fail('__construct() throws an \InvalidArgumentException if the first argument is not a stream');
        } catch (\Exception $e) {
            $this->assertInstanceOf('\InvalidArgumentException', $e, '__construct() throws an \InvalidArgumentException if the first argument is not a stream');
            $this->assertEquals('The StreamOutput class needs a stream as its first argument.', $e->getMessage());
        }

        $output = new StreamOutput($this->stream, Output::VERBOSITY_QUIET, true);
        $this->assertEquals(Output::VERBOSITY_QUIET, $output->getVerbosity(), '__construct() takes the verbosity as its first argument');
        $this->assertTrue($output->isDecorated(), '__construct() takes the decorated flag as its second argument');
    }

    public function testGetStream()
    {
        $output = new StreamOutput($this->stream);
        $this->assertEquals($this->stream, $output->getStream(), '->getStream() returns the current stream');
    }

    public function testDoWrite()
    {
        $output = new StreamOutput($this->stream);
        $output->writeln('foo');
        rewind($output->getStream());
        $this->assertEquals('foo'.PHP_EOL, stream_get_contents($output->getStream()), '->doWrite() writes to the stream');
    }
}
