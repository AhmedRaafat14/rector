<?php

namespace spec\Rector\PhpSpecToPHPUnit\Tests\Rector\Class_\PhpSpecToPHPUnitRector\Fixture;

use Rector\PhpSpecToPHPUnit\Tests\Rector\Class_\PhpSpecToPHPUnitRector\Fixture\ItIsMe;
use PhpSpec\ObjectBehavior;

class ItIsMeSpec extends ObjectBehavior
{
    public function it_is_me()
    {
        $this->shouldHaveType(ItIsMe::class);
    }
}

?>
-----
<?php

namespace Tests\Rector\PhpSpecToPHPUnit\Tests\Rector\Class_\PhpSpecToPHPUnitRector\Fixture;

use Rector\PhpSpecToPHPUnit\Tests\Rector\Class_\PhpSpecToPHPUnitRector\Fixture\ItIsMe;
use PhpSpec\ObjectBehavior;

class ItIsMeTest extends \PHPUnit\Framework\TestCase
{
    private \Rector\PhpSpecToPHPUnit\Tests\Rector\Class_\PhpSpecToPHPUnitRector\Fixture\ItIsMe $itIsMe;
    protected function setUp()
    {
        $this->itIsMe = new \Rector\PhpSpecToPHPUnit\Tests\Rector\Class_\PhpSpecToPHPUnitRector\Fixture\ItIsMe();
    }
}

?>
