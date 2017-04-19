<?php

/* webview/layout/twig/partials/freelancer-sub-header.twig */
class __TwigTemplate_824908792b100f4d5b364c4090cf77a638476d1eb87c6fbf5e63cd7fd032febf extends Twig_Template
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
                        <li><a class=\"first-menu\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, site_url("jobs-search"), "html", null, true);
        echo "\" class=\"current\"> ";
        echo twig_escape_filter($this->env, app_lang("text_app_find_jobs"), "html", null, true);
        echo "</a></li>      
                        <li><a href=\"";
        // line 8
        echo twig_escape_filter($this->env, app_profile_url(), "html", null, true);
        echo "\"> ";
        echo twig_escape_filter($this->env, app_lang("text_app_my_profile"), "html", null, true);
        echo "</a></li>\t\t\t
                        <li><a href=\"";
        // line 9
        echo twig_escape_filter($this->env, site_url("jobs/my-bids"), "html", null, true);
        echo "\"> ";
        echo twig_escape_filter($this->env, app_lang("text_app_my_bid_list"), "html", null, true);
        echo "</a></li>
                        <li><a href=\"";
        // line 10
        echo twig_escape_filter($this->env, site_url("withdraw"), "html", null, true);
        echo "\"> ";
        echo twig_escape_filter($this->env, app_lang("text_app_withdraw"), "html", null, true);
        echo "</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "webview/layout/twig/partials/freelancer-sub-header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 10,  39 => 9,  33 => 8,  27 => 7,  19 => 1,);
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
                        <li><a class=\"first-menu\" href=\"{{ site_url('jobs-search') }}\" class=\"current\"> {{ app_lang('text_app_find_jobs') }}</a></li>      
                        <li><a href=\"{{ app_profile_url() }}\"> {{ app_lang('text_app_my_profile') }}</a></li>\t\t\t
                        <li><a href=\"{{ site_url('jobs/bids_list') }}\"> {{ app_lang('text_app_my_bid_list') }}</a></li>
                        <li><a href=\"{{ site_url('withdraw') }}\"> {{ app_lang('text_app_withdraw') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>", "webview/layout/twig/partials/freelancer-sub-header.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\partials\\freelancer-sub-header.twig");
    }
}
