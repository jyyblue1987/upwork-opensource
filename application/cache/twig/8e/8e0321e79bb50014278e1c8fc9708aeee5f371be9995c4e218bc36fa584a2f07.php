<?php

/* webview/layout/twig/partials/header.twig */
class __TwigTemplate_5f3b862fa40883b961a11c780a913b7ab01815606bfdfd42118f619b505d028c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<section class=\"container-fluid top_header\"> 
    <nav class=\"navbar navbar-default\">
        <div class=\"container\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a class=\"navbar-brand\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, home_url(), "html", null, true);
        echo "\">WINJOB</a>
            </div>
            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                <ul class=\"nav navbar-nav\">
                    ";
        // line 15
        echo twig_include($this->env, $context, app_header_link_template());
        echo "
                </ul>
                <ul class=\"nav navbar-nav navbar-right\">
                    ";
        // line 18
        echo twig_include($this->env, $context, app_user_dropdown_template());
        echo "
                </ul>
            </div>
        </div>
    </nav>
</section>
";
        // line 24
        if ($this->getAttribute(app_user_data(), "loggedx", array(), "array")) {
            // line 25
            echo twig_include($this->env, $context, app_sub_header_template());
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "webview/layout/twig/partials/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 25,  53 => 24,  44 => 18,  38 => 15,  31 => 11,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<section class=\"container-fluid top_header\"> 
    <nav class=\"navbar navbar-default\">
        <div class=\"container\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a class=\"navbar-brand\" href=\"{{ home_url() }}\">WINJOB</a>
            </div>
            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                <ul class=\"nav navbar-nav\">
                    {{ include(app_header_link_template()) }}
                </ul>
                <ul class=\"nav navbar-nav navbar-right\">
                    {{ include(app_user_dropdown_template()) }}
                </ul>
            </div>
        </div>
    </nav>
</section>
{% if app_user_data()['loggedx'] %}
{{ include(app_sub_header_template()) }}
{% endif %}
", "webview/layout/twig/partials/header.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\partials\\header.twig");
    }
}
