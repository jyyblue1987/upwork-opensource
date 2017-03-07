<?php

/* webview/layout/twig/partials/footer.twig */
class __TwigTemplate_e750bc871773f2127b318ecdcb3c44b382f82506f02ba81e0488601dda2e650f extends Twig_Template
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
        echo "<div class=\"clear\"> </div>
<section class=\"big_footer\">
    <div id=\"find-jobs_container\" class=\"container\">
        <div class=\"row\">
\t    <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t        <div class=\"footer-menu\">  
                    <ul>
                       <li><p><b>Winjob</b></p></li>
                       <li><a href=\"";
        // line 9
        echo twig_escape_filter($this->env, site_url("aboutus"), "html", null, true);
        echo "\">About us</a></li>
                       <li><a href=\"";
        // line 10
        echo twig_escape_filter($this->env, site_url("contact"), "html", null, true);
        echo "\">Contact us</a></li>
                       <li>Press</li>
                       <li>Enterprise Soluation</li>
                       <li>Feedback</li>
                   </ul>
\t\t</div>
\t    </div>
            <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t       <div class=\"footer-menu\">  
                    <ul>
                        <li><p><b>Contact Support</b></p></li>
                        <li>Help & Support</li>
                        <li>Trust and Safety</li>
                        <li>Help Make Winjob better</li>
                    </ul>
\t\t </div>
\t    </div>
            <div class=\"clear1\"></div>
\t    <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t      <div class=\"footer-menu\">  
                    <ul>
                         <li><p><b>Information</b></p></li>
                         <li>Fee and Charges</li>
                         <li>Cancellations & Refunds</li>
                         <li><a href=\"";
        // line 34
        echo twig_escape_filter($this->env, site_url("terms"), "html", null, true);
        echo "\">Terms & Conditions</a></li>
                         <li><a href=\"";
        // line 35
        echo twig_escape_filter($this->env, site_url("policy"), "html", null, true);
        echo "\">Privacy Policy</a></li>
                         <li>Desktop App</li>
                    </ul>
\t\t </div>
\t    </div>
            <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t        <div class=\"footer-menu\">  
\t\t    <ul>
\t\t\t<li><p><b>Knowledgebase</b></p></li>
\t\t\t<li>How to Join us?</li>
\t\t\t<li>How to create support tickets?</li>
\t\t\t<li>How to get your work done?</li>
\t\t\t<li>How to add fund?</li>
\t            </ul>
\t\t </div>
\t    </div>
        </div>
    </div>
                         
    <div class=\"footer\">
        <div id=\"find-jobs_container\" class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-6 col-md-6\"><h1><b>WINJOB</b></h1></div>
                <div class=\"col-sm-6 col-md-6\"><p>© 2016 WINJOB</p></div>
            </div>
        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "webview/layout/twig/partials/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 35,  60 => 34,  33 => 10,  29 => 9,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"clear\"> </div>
<section class=\"big_footer\">
    <div id=\"find-jobs_container\" class=\"container\">
        <div class=\"row\">
\t    <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t        <div class=\"footer-menu\">  
                    <ul>
                       <li><p><b>Winjob</b></p></li>
                       <li><a href=\"{{ site_url(\"aboutus\") }}\">About us</a></li>
                       <li><a href=\"{{ site_url(\"contact\") }}\">Contact us</a></li>
                       <li>Press</li>
                       <li>Enterprise Soluation</li>
                       <li>Feedback</li>
                   </ul>
\t\t</div>
\t    </div>
            <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t       <div class=\"footer-menu\">  
                    <ul>
                        <li><p><b>Contact Support</b></p></li>
                        <li>Help & Support</li>
                        <li>Trust and Safety</li>
                        <li>Help Make Winjob better</li>
                    </ul>
\t\t </div>
\t    </div>
            <div class=\"clear1\"></div>
\t    <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t      <div class=\"footer-menu\">  
                    <ul>
                         <li><p><b>Information</b></p></li>
                         <li>Fee and Charges</li>
                         <li>Cancellations & Refunds</li>
                         <li><a href=\"{{ site_url(\"terms\") }}\">Terms & Conditions</a></li>
                         <li><a href=\"{{ site_url(\"policy\") }}\">Privacy Policy</a></li>
                         <li>Desktop App</li>
                    </ul>
\t\t </div>
\t    </div>
            <div class=\"col-sm-6 col-md-6 col-lg-3\">
\t        <div class=\"footer-menu\">  
\t\t    <ul>
\t\t\t<li><p><b>Knowledgebase</b></p></li>
\t\t\t<li>How to Join us?</li>
\t\t\t<li>How to create support tickets?</li>
\t\t\t<li>How to get your work done?</li>
\t\t\t<li>How to add fund?</li>
\t            </ul>
\t\t </div>
\t    </div>
        </div>
    </div>
                         
    <div class=\"footer\">
        <div id=\"find-jobs_container\" class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-6 col-md-6\"><h1><b>WINJOB</b></h1></div>
                <div class=\"col-sm-6 col-md-6\"><p>© 2016 WINJOB</p></div>
            </div>
        </div>
    </div>
</section>", "webview/layout/twig/partials/footer.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\layout\\twig\\partials\\footer.twig");
    }
}
