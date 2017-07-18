<?php

class __BingoTemplates_201d2e9610977bebc7d8fc91fc4c9f9b extends Mustache_Template
{
    protected $strictCallables = true;
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<!doctype HTML>
';
        $buffer .= $indent . '    <html>
';
        $buffer .= $indent . '        <head>
';
        $buffer .= $indent . '            <meta charset="utf-8">
';
        $buffer .= $indent . '            <title>Sample</title>
';
        $buffer .= $indent . '        </head>
';
        $buffer .= $indent . '        <body>
';
        $buffer .= $indent . '            <!--Sample document-->
';
        $buffer .= $indent . '            <h1>';
        $value = $this->resolveValue($context->find('title'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</h1>
';
        $buffer .= $indent . '            <script src="bower_components/cycle/dist/cycle.js"></script>
';
        $buffer .= $indent . '        </body>
';
        $buffer .= $indent . '    </html>
';

        return $buffer;
    }
}
