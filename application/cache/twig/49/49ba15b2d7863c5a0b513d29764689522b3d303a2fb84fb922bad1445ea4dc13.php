<?php

/* webview/jobs/my-staff.twig */
class __TwigTemplate_1b9b41ebfa8d4e76f6929e7df0813721bddd4fec14d836fdc0953fd724c70e49 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("webview/layout/twig/layout.twig", "webview/jobs/my-staff.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'commonjs' => array($this, 'block_commonjs'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "webview/layout/twig/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <h1>My Staff</h1>
";
    }

    // line 7
    public function block_commonjs($context, array $blocks = array())
    {
        // line 8
        echo "    <script data-main=\"";
        echo twig_escape_filter($this->env, app_modular_js("mystaff"), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, app_modular_js("lib/require.dev.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "webview/jobs/my-staff.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 8,  37 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"webview/layout/twig/layout.twig\" %}

{% block content %}
    <h1>My Staff</h1>
{% endblock %}

{% block commonjs %}
    <script data-main=\"{{ app_modular_js(\"mystaff\") }}\" src=\"{{ app_modular_js(\"lib/require.dev.js\") }}\"></script>
{% endblock %}
", "webview/jobs/my-staff.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\my-staff.twig");
    }
}
