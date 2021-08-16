<?php

class Excel_test extends TestCase
{
    public function test_index()
    {
        $output = $this->request('GET','generate-csv');
        $expected = "File has been overwritten successfully.";
        $this->assertContains($expected,$output);
    }
}
?>