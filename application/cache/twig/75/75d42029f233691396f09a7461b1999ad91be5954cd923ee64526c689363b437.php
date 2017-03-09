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
       <i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> Find Job  
   </a>
</li>
<li>
    <a href=\"";
        // line 7
        echo twig_escape_filter($this->env, site_url("winsjob"), "html", null, true);
        echo "\">  
        <img src=\"/assets/img/version1/cup.png\"  style=\"height:20px; width:10px; margin-top:0px;\"/> 
        Win Jobs  
    </a>
</li> 
<li>
    <a href=\"";
        // line 13
        echo twig_escape_filter($this->env, site_url("pay/freelancerbalance"), "html", null, true);
        echo "\">
        <i class=\"fa fa-cc-discover\" aria-hidden=\"true\"></i>  
        Balance 
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
        return array (  39 => 13,  30 => 7,  22 => 2,  19 => 1,);
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
       <i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i> Find Job  
   </a>
</li>
<li>
    <a href=\"{{ site_url('winsjob') }}\">  
        <img src=\"/assets/img/version1/cup.png\"  style=\"height:20px; width:10px; margin-top:0px;\"/> 
        Win Jobs  
    </a>
</li> 
<li>
    <a href=\"{{ site_url('pay/freelancerbalance') }}\">
        <i class=\"fa fa-cc-discover\" aria-hidden=\"true\"></i>  
        Balance 
    </a>
</li>
", "webview/layout/twig/partials/freelancer-header-links.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\partials\\freelancer-header-links.twig");
    }
}
