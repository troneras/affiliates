<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommandTest extends TestCase
{
    use WithFaker;


    /**
     * Test affiliate:filter CLI command
     *
     * @return void
     * @group affiliates
     */
    public function test_affiliates_search_command()
    {
        $this->artisan('affiliates:search', ['--radius' => 100, '--order' => 'affiliate_id'])
            ->expectsTable(['ID', 'Name', 'Distance'], array(
                0 =>
                    array(
                        0 => 39,
                        1 => 'Kirandeep Browning',
                        2 => '37.8',
                    ),
                1 =>
                    array(
                        0 => 31,
                        1 => 'Maisha Mccarty',
                        2 => '44.3',
                    ),
                2 =>
                    array(
                        0 => 30,
                        1 => 'Kingsley Vang',
                        2 => '83.2',
                    ),
                3 =>
                    array(
                        0 => 29,
                        1 => 'Alvin Stamp',
                        2 => '72.8',
                    ),
                4 =>
                    array(
                        0 => 26,
                        1 => 'Moesha Bateman',
                        2 => '98.9',
                    ),
                5 =>
                    array(
                        0 => 24,
                        1 => 'Ellena Olson',
                        2 => '89.7',
                    ),
                6 =>
                    array(
                        0 => 23,
                        1 => 'Ciara Bannister',
                        2 => '83.3',
                    ),
                7 =>
                    array(
                        0 => 17,
                        1 => 'Gino Partridge',
                        2 => '96.6',
                    ),
                8 =>
                    array(
                        0 => 15,
                        1 => 'Veronica Haines',
                        2 => '43.2',
                    ),
                9 =>
                    array(
                        0 => 13,
                        1 => 'Terence Wall',
                        2 => '62.1',
                    ),
                10 =>
                    array(
                        0 => 12,
                        1 => 'Yosef Giles',
                        2 => '41.1',
                    ),
                11 =>
                    array(
                        0 => 11,
                        1 => 'Isla-Rose Hubbard',
                        2 => '37.5',
                    ),
                12 =>
                    array(
                        0 => 8,
                        1 => 'Addison Lister',
                        2 => '84.1',
                    ),
                13 =>
                    array(
                        0 => 6,
                        1 => 'Jez Greene',
                        2 => '23.5',
                    ),
                14 =>
                    array(
                        0 => 5,
                        1 => 'Sharna Marriott',
                        2 => '22.7',
                    ),
                15 =>
                    array(
                        0 => 4,
                        1 => 'Inez Blair',
                        2 => '9.9',
                    ),
            ));

    }
}
