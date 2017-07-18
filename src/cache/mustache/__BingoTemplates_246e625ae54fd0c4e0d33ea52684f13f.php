<?php

class __BingoTemplates_246e625ae54fd0c4e0d33ea52684f13f extends Mustache_Template
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
        $buffer .= $indent . '            ';
        $buffer .= '
';
        $buffer .= $indent . '            <h1>';
        $value = $this->resolveValue($context->find('title'), $context);
        $filter = $context->findDot('case.lower');
        if (!(is_object($filter) && is_callable($filter))) {
            throw new Mustache_Exception_UnknownFilterException('case.lower');
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
