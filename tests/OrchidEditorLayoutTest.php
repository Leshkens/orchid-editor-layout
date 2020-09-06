<?php

namespace Leshkens\OrchidEditorLayout\Tests;

use Leshkens\OrchidEditorLayout\Facades\OrchidEditorLayout;
use Leshkens\OrchidEditorLayout\ServiceProvider;
use Orchestra\Testbench\TestCase;

class OrchidEditorLayoutTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'orchid-editor-layout' => OrchidEditorLayout::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
