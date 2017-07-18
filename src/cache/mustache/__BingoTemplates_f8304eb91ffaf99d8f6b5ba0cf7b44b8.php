<?php

class __BingoTemplates_f8304eb91ffaf99d8f6b5ba0cf7b44b8 extends Mustache_Template
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
        $filter = $context->find('lower');
        if (!(is_object($filter) && is_callable($filter))) {
            throw new Mustache_Exception_UnknownFilterException('lower');
        }
        $value = call_user_func($filter, $value);
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
