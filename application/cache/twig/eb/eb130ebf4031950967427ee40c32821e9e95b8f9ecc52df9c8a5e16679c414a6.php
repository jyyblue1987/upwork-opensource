<?php

/* webview/layout/twig/partials/client-sub-header.twig */
class __TwigTemplate_be8796f3ffd52a043f743eccbde7a45343f1447981333ad2f867c4165e30013d extends Twig_Template
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
        echo "<div id=\"next_header\">
    <div class=\"container\">
        <div class=\"row\"> 
            <div class=\"col-xs-12 col-sm-12 col-md-12\">
                <div class=\"menu\">
                    <ul>  
                        <li><a href=\"";
        // line 7
        echo twig_escape_filter($this->env, site_url("post-job/"), "html", null, true);
        echo "\" class=\"current\">";
        echo twig_escape_filter($this->env, app_lang("text_app_post_a_job"), "html", null, true);
        echo "</a></li>      
                        <li><a href=\"";
        // line 8
        echo twig_escape_filter($this->env, site_url("jobs/my-contracts"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, app_lang("text_app_my_contracts"), "html", null, true);
        echo "</a></li>\t\t\t
                        <li><a href=\"#\">";
        // line 9
        echo twig_escape_filter($this->env, app_lang("text_app_work_history"), "html", null, true);
        echo "</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>    
";
    }

    public function getTemplateName()
    {
        return "webview/layout/twig/partials/client-sub-header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 9,  33 => 8,  27 => 7,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"next_header\">
    <div class=\"container\">
        <div class=\"row\"> 
            <div class=\"col-xs-12 col-sm-12 col-md-12\">
                <div class=\"menu\">
                    <ul>  
                        <li><a href=\"{{ site_url(\"post-job/\") }}\" class=\"current\">{{ app_lang('text_app_post_a_job') }}</a></li>      
                        <li><a href=\"{{ site_url(\"jobs/my-contracts\") }}\">{{ app_lang('text_app_my_contracts') }}</a></li>\t\t\t
                        <li><a href=\"#\">{{ app_lang('text_app_work_history') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>    
", "webview/layout/twig/partials/client-sub-header.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\partials\\client-sub-header.twig");
    }
}
