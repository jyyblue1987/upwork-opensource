<?php

/* webview/layout/twig/partials/freelancer-header-links.twig */
class __TwigTemplate_53706cc21d8c03589e08e73df30ee9d98cd994256ba16facc125aaa1183e8786 extends Twig_Template
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
        echo "<li>
   <a href=\"";
        // line 2
        echo twig_escape_filter($this->env, site_url("find-jobs"), "html", null, true);
        echo "\">
       <i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i>
       ";
        // line 4
        echo twig_escape_filter($this->env, app_lang("text_app_find_job"), "html", null, true);
        echo "
   </a>
</li>
<li>
    <a href=\"";
        // line 8
        echo twig_escape_filter($this->env, site_url("win-jobs"), "html", null, true);
        echo "\">  
        <i class=\"fa fa-trophy\" aria-hidden=\"true\"></i>
        ";
        // line 10
        echo twig_escape_filter($this->env, app_lang("text_app_win_jobs"), "html", null, true);
        echo " 
    </a>
</li> 
<li>
    <a href=\"";
        // line 14
        echo twig_escape_filter($this->env, site_url("pay/freelancerbalance"), "html", null, true);
        echo "\">
        <i class=\"fa fa-credit-card\" aria-hidden=\"true\"></i>
        ";
        // line 16
        echo twig_escape_filter($this->env, app_lang("text_app_balance"), "html", null, true);
        echo " 
    </a>
</li>
";
    }

    public function getTemplateName()
    {
        return "webview/layout/twig/partials/freelancer-header-links.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 16,  46 => 14,  39 => 10,  34 => 8,  27 => 4,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<li>
   <a href=\"{{ site_url('find-jobs') }}\">
       <i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i>
       {{ app_lang('text_app_find_job') }}
   </a>
</li>
<li>
    <a href=\"{{ site_url('win-jobs') }}\">  
        <i class=\"fa fa-trophy\" aria-hidden=\"true\"></i>
        {{ app_lang('text_app_win_jobs') }} 
    </a>
</li> 
<li>
    <a href=\"{{ site_url('pay/freelancerbalance') }}\">
        <i class=\"fa fa-credit-card\" aria-hidden=\"true\"></i>
        {{ app_lang('text_app_balance') }} 
    </a>
</li>
", "webview/layout/twig/partials/freelancer-header-links.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\partials\\freelancer-header-links.twig");
    }
}
