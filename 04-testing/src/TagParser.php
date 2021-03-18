<?php

namespace App;

class TagParser
{
    public function parse(string $tagString)
    {
        return preg_split('/(\s+)?[,|](\s+)?/', $tagString);
    }
}
