<?php

class __BingoTemplates_0fa929a468106c6c0d85fcc6701829c4 extends Mustache_Template
{
    protected $strictCallables = true;
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

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
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
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
